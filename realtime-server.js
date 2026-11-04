import express from 'express';
import { createServer } from 'http';
import { Server } from 'socket.io';
import cors from 'cors';
import dotenv from 'dotenv';
import pg from 'pg';

dotenv.config();

const app = express();
app.use(cors());
app.use(express.json());

const server = createServer(app);
const io = new Server(server, {
    cors: {
        origin: '*',
        methods: ['GET', 'POST']
    }
});

const PORT = process.env.NODE_SOCKET_PORT || 3000;

// PostgreSQL Connection
const pool = new pg.Pool({
    user: process.env.DB_USERNAME || 'postgres',
    host: process.env.DB_HOST || '127.0.0.1',
    database: process.env.DB_DATABASE || 'vivah_connect',
    password: process.env.DB_PASSWORD || 'postgres',
    port: parseInt(process.env.DB_PORT || '5432', 10),
});

// Dowry regex patterns (Legal Framework: Dowry Prohibition Act)
const DOWRY_REGEX = /\b(dowry|dahej|paun|pon|joutuk|joutuker|demand\s+money|cash\s+demand|lakh|crore|taka\s+lagbe|shona\s+lagbe|bhori|gold\s+demand)\b/i;

// Contact shielding regex patterns
const PHONE_REGEX = /(\+?[0-9]{1,4}[\s\-\.]?)?(\(?\d{2,4}\)?[\s\-\.]?)?\d{3,4}[\s\-\.]?\d{3,4}|\b(zero|one|two|three|four|five|six|seven|eight|nine)(\s+(zero|one|two|three|four|five|six|seven|eight|nine)){4,}\b/i;
const EMAIL_REGEX = /[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/i;
const SOCIAL_REGEX = /\b(whatsapp|wa\.me|wa|imo|viber|telegram|tg|insta|instagram|ig|fb|facebook)\s*(id|handle|number|no|:)?\s*[:\-@]?\s*[\w\.\+]{4,}|\b@[a-zA-Z0-9_]{4,}\b/i;

function formatSystemDateTime(date) {
    const d = new Date(date);
    const day = String(d.getDate()).padStart(2, '0');
    const month = String(d.getMonth() + 1).padStart(2, '0');
    const year = d.getFullYear();
    const hours = String(d.getHours()).padStart(2, '0');
    const mins = String(d.getMinutes()).padStart(2, '0');
    return `${day}/${month}/${year} ${hours}:${mins}`;
}

function maskContent(text) {
    let masked = text;
    let hasMasked = false;

    if (EMAIL_REGEX.test(masked)) {
        masked = masked.replace(EMAIL_REGEX, '[EMAIL PROTECTED]');
        hasMasked = true;
    }
    if (PHONE_REGEX.test(masked)) {
        masked = masked.replace(PHONE_REGEX, '[PHONE PROTECTED - USE MUTUAL CONTACT EXCHANGE]');
        hasMasked = true;
    }
    if (SOCIAL_REGEX.test(masked)) {
        masked = masked.replace(SOCIAL_REGEX, '[HANDLE PROTECTED]');
        hasMasked = true;
    }

    return { masked, hasMasked };
}

// Track active sockets per user
const activeUsers = new Map(); // userId -> Set of socketIds

io.on('connection', (socket) => {
    const userId = socket.handshake.query.userId;
    if (userId) {
        if (!activeUsers.has(userId)) {
            activeUsers.set(userId, new Set());
        }
        activeUsers.get(userId).add(socket.id);
        socket.join(`user_${userId}`);
    }

    // Join a chaperoned conversation room
    socket.on('join_conversation', ({ userA, userB }) => {
        const sortedIds = [parseInt(userA, 10), parseInt(userB, 10)].sort((a, b) => a - b);
        const roomId = `room_${sortedIds[0]}_${sortedIds[1]}`;
        socket.join(roomId);
    });

    // Send Real-Time Chaperoned Chat Message
    socket.on('send_message', async (data, callback) => {
        try {
            const { senderId, receiverId, content } = data;
            const sId = parseInt(senderId, 10);
            const rId = parseInt(receiverId, 10);

            // 1. Dowry detection
            if (DOWRY_REGEX.test(content)) {
                const blockedResult = {
                    error: true,
                    dowry_flagged: true,
                    message: 'Message blocked by statutory anti-dowry filter. Dowry solicitation is prohibited under law.',
                };
                if (callback) callback(blockedResult);
                socket.emit('message_blocked', blockedResult);

                // Insert into audit logs & user_reports
                await pool.query(
                    `INSERT INTO user_reports (reporter_id, reported_id, category, details, status, created_at, updated_at) 
                     VALUES ($1, $2, 'dowry_demand', $3, 'pending', NOW(), NOW())`,
                    [rId, sId, `Automated Socket Flag: Message containing "${content.substring(0, 100)}" was blocked.`]
                );
                return;
            }

            // 2. Real-time Contact Shielding
            const { masked, hasMasked } = maskContent(content);

            // 3. Persist to PostgreSQL
            const result = await pool.query(
                `INSERT INTO messages (sender_user_id, receiver_user_id, content, displayed_content, has_masked_contacts, dowry_flagged, status, created_at, updated_at) 
                 VALUES ($1, $2, $3, $4, $5, false, 'delivered', NOW(), NOW()) 
                 RETURNING id, sender_user_id, receiver_user_id, displayed_content, has_masked_contacts, created_at`,
                [sId, rId, content, masked, hasMasked]
            );

            const savedMessage = result.rows[0];

            // 4. Broadcast to the conversation room
            const sortedIds = [sId, rId].sort((a, b) => a - b);
            const roomId = `room_${sortedIds[0]}_${sortedIds[1]}`;
            
            io.to(roomId).emit('new_message', {
                ...savedMessage,
                timestamp: formatSystemDateTime(savedMessage.created_at),
            });

            // 5. Notify Family Representatives with Chaperone Oversight
            const repsResult = await pool.query(
                `SELECT rep_user_id FROM family_representatives WHERE seeker_user_id IN ($1, $2)`,
                [sId, rId]
            );

            for (const rep of repsResult.rows) {
                io.to(`user_${rep.rep_user_id}`).emit('chaperone_oversight_update', {
                    conversation_room: roomId,
                    sender_id: sId,
                    receiver_id: rId,
                    snippet: masked.substring(0, 50),
                    time: formatSystemDateTime(new Date()),
                });
            }

            if (callback) callback({ success: true, message: savedMessage });
        } catch (err) {
            console.error('Socket send_message error:', err);
            if (callback) callback({ error: true, message: 'Message transmission failed.' });
        }
    });

    socket.on('disconnect', () => {
        if (userId && activeUsers.has(userId)) {
            activeUsers.get(userId).delete(socket.id);
            if (activeUsers.get(userId).size === 0) {
                activeUsers.delete(userId);
            }
        }
    });
});

// REST Health Check & Webhook Endpoints
app.get('/api/health', (req, res) => {
    res.json({
        status: 'online',
        service: 'Vivah Connect Real-Time Node.js Chaperoned Communication Gateway',
        active_users_count: activeUsers.size,
        timestamp: new Date().toISOString(),
    });
});

app.post('/api/broadcast-proposal', (req, res) => {
    const { receiverId, proposal } = req.body;
    if (receiverId) {
        io.to(`user_${receiverId}`).emit('new_proposal_received', proposal);
    }
    res.json({ success: true });
});

server.listen(PORT, () => {
    console.log(`[Vivah Connect] Real-Time Node.js Server listening on port ${PORT}`);
});

