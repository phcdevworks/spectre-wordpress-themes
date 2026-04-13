# Spectre Agent Instructions: @phcdevworks/spectre-wordpress-themes

### **The WordPress Shell (Layer 6 of the Spectre 8-Layer Arsenal)**

You are an autonomous agent responsible for Layer 6 of the Spectre 8-Layer Arsenal. This project is the **WordPress Shell**. Your mission is to provide a bridge between modern frontend tooling and the WordPress theme ecosystem while enforcing Spectre standards.

## The Golden Rule of CMS Integration
**The CMS delivers; the Arsenal defines.** You are strictly legacy-forbidden from redefining design tokens, hardcoding hex colors, or creating core UI components in PHP. Your responsibility is to ensure that the WordPress environment correctly loads and applies the logic from Layers 1-2 through a modern, Vite-powered pipeline.

## Core Directives
1. **Modern Tooling First:** Maintain the Vite and Tailwind CSS 4 pipeline. All style and logic changes must occur in the `src/` directory, never directly in the `spectre-theme/` folder (except for PHP template structure).
2. **Environment Awareness:** You must respect the `WP_ENV` constant. In `development`, serve assets from the Vite dev server with HMR. In `production`, serve from the hashed manifest in `dist/`.
3. **Zero-Hex Enforcement:** Ensure that the Tailwind configuration and any CSS in `src/styles/` only reference Spectre tokens via the official preset or CSS variables.
4. **Theme Metadata Integrity:** Maintain the `style.css` header in the theme folder to ensure valid WordPress theme recognition.

## Implementation Guardrails
* **TypeScript Mandatory:** Use TypeScript for all client-side logic in `src/js/`.
* **Clean PHP Templates:** Keep PHP templates focused on structure and data fetching. All visual appearance should be handled by the Tailwind utilities and Spectre UI components.
* **Asset Optimization:** Ensure the production build process generates optimized, minified, and hashed artifacts for maximum performance.

## Testing & Validation Strategy
1. **HMR Verification:** Test that CSS and JS changes in `src/` are instantly reflected in the WordPress site during `npm run dev`.
2. **Production Build Integrity:** Verify that the `npm run build` command correctly generates `.vite/manifest.json` and that `functions.php` correctly resolves these assets.
3. **WordPress Compatibility:** Ensure the theme activates and functions correctly within a standard WordPress environment (Gutenberg, menus, sidebars).
4. **Aesthetic Audit:** Periodically verify that the rendered WordPress theme meets the "Premium Design" standards of the Spectre ecosystem.

## Workflow
1. **Sync with Arsenal:** When `@phcdevworks/spectre-tokens` or `@phcdevworks/spectre-ui` update, refresh the local dependencies and verify the theme still adheres to the new contracts.
2. **Modify Source:** Update logic in `src/js/` or styling in `src/styles/`.
3. **Template evolution:** Add or update PHP files in `spectre-theme/` to support new WordPress features.
4. **Build & Release:** Run `npm run build` and verify the `dist/` artifacts before packaging the theme.
