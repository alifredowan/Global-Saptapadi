---
name: Global Saptapadi
description: Handcrafted Heritage & Heirloom Invitation — Sacred Hindu Matrimony
colors:
  primary: "#8B1E2D"
  primary-hover: "#6E1723"
  primary-soft: "#F8E9EB"
  accent: "#E07B1A"
  accent-hover: "#BF640E"
  accent-soft: "#FDEBD6"
  haldi: "#F2B01E"
  haldi-soft: "#FFF5D6"
  tulsi: "#2F7D4F"
  tulsi-soft: "#EDF7F2"
  neutral-bg: "#FFFBF3"
  neutral-surface: "#FFFFFF"
  neutral-surface-alt: "#F8F1E4"
  ink-dark: "#4A0F1A"
  ink-darker: "#330A12"
  text-primary: "#1A1A1A"
  text-secondary: "#4B5563"
  border-default: "#EADFCB"
  border-subtle: "#F3EBDD"
typography:
  display:
    fontFamily: "'Cormorant Garamond', Georgia, serif"
    fontWeight: 700
    lineHeight: 1.15
    letterSpacing: "-0.015em"
  headline:
    fontFamily: "'Cormorant Garamond', Georgia, serif"
    fontWeight: 600
    lineHeight: 1.25
  body:
    fontFamily: "'DM Sans', -apple-system, BlinkMacSystemFont, sans-serif"
    fontWeight: 450
    lineHeight: 1.6
    letterSpacing: "0em"
rounded:
  xs: "2px"
  sm: "4px"
  md: "8px"
  lg: "12px"
components:
  button-primary:
    backgroundColor: "{colors.primary}"
    textColor: "#FFFFFF"
    rounded: "{rounded.sm}"
    height: "48px"
  button-saffron:
    backgroundColor: "{colors.accent}"
    textColor: "{colors.ink-darker}"
    rounded: "{rounded.sm}"
    height: "48px"
  button-secondary:
    backgroundColor: "transparent"
    textColor: "{colors.primary}"
    rounded: "{rounded.sm}"
    height: "48px"
---

## Overview

Global Saptapadi's visual system is rooted in the **Handcrafted Heritage & Heirloom Invitation (Lagan Patrika / Vivah Nimantran)** aesthetic. It rejects the generic, cold SaaS conventions of dating apps and commercial matrimonial portals in favor of sacred dignity, familial warmth, tactile khadi paper texture, and ceremonial reverie.

## Colors

- **Kumkum Maroon (`#8B1E2D`)**: The primary spiritual signature representing marriage, sindoor, shakti, and auspicious beginnings. Used for primary actions, critical seals, and brand presence.
- **Agni Saffron (`#E07B1A`)**: The sacred fire of the Saptapadi. Represents devotion, pure commitment, and energetic warmth. Used for featured action accents and ceremonial highlights.
- **Haldi Turmeric (`#F2B01E`)**: Celebration, joy, and bridal blessings. Used softly in supporting tags, decorative elements, and status seals.
- **Tulsi Green (`#2F7D4F`)**: Nature, truth, and growth. Strictly reserved for verified badges and successful compatibility signals.
- **Warm Ivory / Khadi Paper (`#FFFBF3`)**: The authentic paper canvas. Gives surfaces a tactile, heirloom stationery feel rather than sterile white plastic.
- **Temple Ink (`#4A0F1A` to `#330A12`)**: Deep ceremonial ground used for dark hearth bands, footers, and contrasting evening sections.

## Typography

- **Headings & Ceremonial Proclamations**: `Cormorant Garamond`, Georgia, serif. High-contrast, literary, and regal. Carries the spiritual weight of Vedic vows.
- **Body & Functional UI**: `DM Sans`. Clean, readable, and modern. Formatted with generous line height (1.6) and comfortable measure (65–75ch) for elder and candidate readability across all devices.

## Layout

- **The Heirloom Folio**: Pages are structured as ceremonial scrolls and archival folios rather than repetitive card grids.
- **Asymmetric Narrative Balance**: Pairs editorial copy with tactile biodata dossiers (Sampark Patrika) and interactive Vedic pathways.
- **Bespoke Framing**: Uses delicate, authentic Alpona corner motifs and 1px warm neutral inner borders (`rgba(224, 123, 26, 0.22)`) instead of heavy dropshadows.

## Elevation & Depth

- **Tactile Paper Grain**: Subtle dual radial gradient background evoking handmade cotton rag paper.
- **Soft Ambient Warm Shadows**: Zero-offset colored halos and harsh neobrutalist shadows are banned. Depth is created through warm tonal contrast (`rgba(74, 15, 26, 0.04)`) and layered stationery borders.

## Shapes

- **Restrained Architectural Radii**: 4px (`--radius-sm`) for interactive controls and 8px (`--radius-md`) for folios. Avoids bubbly, toy-like pills.
- **The Silk Veil**: Photo privacy is communicated through a warm frosted chiffon veil (`silk-veil`) rather than a broken-image glitch or aggressive grey blackout.

## Components

- **Primary Button (`.btn-primary`)**: Solid Kumkum Maroon with white text and smooth micro-elevation on hover.
- **Ceremonial Button (`.btn-saffron`)**: Rich Agni Saffron with deep ink text (`#330A12`) for high-contrast invitations.
- **Secondary Button (`.btn-secondary`)**: Transparent with a crisp 1px Kumkum Maroon border.
- **Heirloom Folio (`.heirloom-folio`)**: The primary content container, featuring subtle double borders and Alpona corner accents.
- **The Seven Steps Path (`.saptapadi-path`)**: An illuminated journey representing the seven Vedic vows with genuine Sanskrit mantras.

## Do's and Don'ts

### Do's
- Preserve sacred, family-honoring terminology (Saptapadi, Guna Milan, Gotra, Shubho Bibaho).
- Maintain high contrast (WCAG AAA) on text and interactive controls.
- Use genuine SVG iconography drawn with consistent 1.5px stroke weight.
- Let headings speak for themselves without artificial labels.

### Don'ts
- **No Eyebrows/Kickers**: Never place small uppercase kicker tags above headings.
- **No Same-Size Card Grids**: Never assemble a page out of identical box-with-icon-and-text components.
- **No Nested Cards**: Never put cards inside cards.
- **No Gradient Text**: Never apply rainbow or linear gradient fills to typography.
- **No Generic Dating Mechanics**: Never use swipe terminology, casual hookup slang, or commercial broker gimmicks.
