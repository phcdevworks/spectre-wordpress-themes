# @phcdevworks/spectre-wordpress-themes

[![GitHub issues](https://img.shields.io/github/issues/phcdevworks/spectre-wordpress-themes)](https://github.com/phcdevworks/spectre-wordpress-themes/issues)
[![GitHub pull requests](https://img.shields.io/github/issues-pr/phcdevworks/spectre-wordpress-themes)](https://github.com/phcdevworks/spectre-wordpress-themes/pulls)
[![License](https://img.shields.io/github/license/phcdevworks/spectre-wordpress-themes)](LICENSE)

@phcdevworks/spectre-wordpress-themes is a high-performance theme foundation for WordPress based sites. It combines a standard WordPress theme directory with a Vite build pipeline, a TypeScript client entrypoint, and Tailwind CSS so teams can build theme-owned assets with a modern frontend workflow and deliver them through WordPress.

This repository is for developers building custom WordPress themes that need to stay aligned with Spectre tokens and Spectre UI without moving design-system ownership into PHP templates.

## Design system guardrail

**The CMS delivers; the design system defines.** This theme should never become a second design system. WordPress owns template structure and data delivery; Spectre packages own visual meaning, styling contracts, and components.

Use this rule when making changes:

- Use `@phcdevworks/spectre-tokens` for values through `var(--sp-*)`
- Use `@phcdevworks/spectre-ui` for shared styling contracts
- Use `@phcdevworks/spectre-components` for controls and form elements such as `<sp-button>` and `<sp-input>`
- Keep PHP templates structural, with semantic shell classes and WordPress functions
- Keep theme-specific styling in `src/styles/main.css`, and only with Spectre token variables

Do not add local hex colors, raw RGB/HSL/OKLCH values, gradients, pixel/rem/em constants, or Tailwind presentation utilities for visual decisions in PHP templates.

## What this repository is

- A WordPress theme foundation with Vite-powered asset compilation
- A TypeScript and Tailwind CSS workspace for theme-owned frontend code
- A theme runtime that switches between the Vite dev server in development and hashed build assets in production
- A WordPress integration layer that enqueues the compiled theme assets from spectre-theme

## What it owns

- The Vite build configuration for theme assets
- The TypeScript entrypoint in src/js/main.ts
- The CSS entrypoint in src/styles/main.css
- The WordPress theme files in spectre-theme, including asset loading in functions.php
- The compiled output for theme-owned assets in spectre-theme/dist

The build is configured around one JavaScript entry and one CSS entry. In production, the theme resolves those compiled assets from the Vite manifest and serves one compiled JS bundle plus one compiled CSS bundle for the theme-owned frontend surface.

## What it does not own

- Design token definitions
- Reusable UI component contracts and recipes
- WordPress core installation, plugin management, or hosting concerns
- Application state architecture beyond the theme entrypoint

## Relationship to Spectre packages

- @phcdevworks/spectre-tokens provides the design tokens consumed by the frontend layer
- @phcdevworks/spectre-ui provides Spectre UI styles and primitives used by the theme layer
- @phcdevworks/spectre-components provides the web components used directly in WordPress templates

This repository is where those frontend foundations are delivered through a WordPress theme. The theme should consume Spectre tokens and Spectre UI output, not redefine them.

By default, the theme stylesheet imports the Spectre UI default bundle, so a fresh install starts from Spectre UI instead of a generic Tailwind-only baseline.

## Styling rules

PHP templates may use semantic shell classes such as `spectre-site-container`, `spectre-main`, `spectre-panel`, and `spectre-card`. Those classes live in `src/styles/main.css` and must remain token-backed.

Avoid adding Tailwind presentation utilities directly to PHP templates for color, spacing, type, radius, shadow, or layout decisions. Examples to avoid include:

    text-white
    rounded-*
    shadow-*
    tracking-*
    p-* / px-* / py-*
    gap-* / space-y-*
    max-w-* / w-* / h-*

When a new reusable visual pattern is needed, prefer adding or updating it in `@phcdevworks/spectre-ui` or `@phcdevworks/spectre-components`. The WordPress theme may carry a small token-driven shell bridge, but it should not become the permanent home for reusable component styling.

## Repository structure

- src/js/main.ts contains the theme JavaScript entrypoint
- src/styles/main.css contains the theme CSS entrypoint
- spectre-theme contains the WordPress theme files
- spectre-theme/functions.php handles development and production asset loading
- spectre-theme/dist receives compiled build output

The deployable WordPress theme directory in this repository is "spectre-theme/". The package and repository name remain "spectre-wordpress-themes".
- vite.config.ts defines the build and dev-server behavior

## Development workflow

1. Install dependencies.

    npm install

2. Start the Vite dev server.

    npm run dev

3. Make the theme available to WordPress by symlinking or copying spectre-theme into your local WordPress install.

    ln -s /path/to/spectre-wordpress-themes/spectre-theme /path/to/wordpress/wp-content/themes/spectre-theme

4. Set your WordPress environment to development mode so the theme loads assets from the Vite dev server instead of the dist folder. Add one of the following to wp-config.php:

    define('WP_ENV', 'development');

    Or use the WordPress environment type API (WordPress 5.5+):

    define('WP_ENVIRONMENT_TYPE', 'development');

    The Vite dev server runs on http://localhost:5173 by default. To use a different port, define the server URL in wp-config.php:

    define('VITE_DEV_SERVER', 'http://localhost:5174');

5. CSS and JavaScript changes in src/ are reflected instantly in the browser via HMR without a page reload.

6. Build production assets when ready to deploy.

    npm run build

7. Validate the theme asset contract after a production build when you change entrypoints or Vite output behavior.

    npm run check:assets

The production build writes hashed assets and .vite/manifest.json to spectre-theme/dist, and the theme uses that manifest to enqueue the compiled files.

## Validation and drift checks

Run the standard validation flow before handing off changes:

    npm run build
    npm run check:assets
    npm run lint
    npm run lint:php

Run this scan after visual or template work to catch design-system drift:

    rg -n "#[0-9a-fA-F]{3,8}|rgb\(|rgba\(|hsl\(|hsla\(|oklch\(|linear-gradient|\btext-white\b|rounded-|shadow-|tracking-|\bprose\b|\btext-[0-9]|\bp-[0-9]|\bpx-[0-9]|\bpy-[0-9]|\bgap-[0-9]|\bspace-y-|\bmax-w-|\bw-[0-9]|\bh-[0-9]|min-width: [0-9]|[0-9]+px|[0-9]+rem|[0-9]+em" src spectre-theme package.json

Expected results should be empty or clearly token-backed, such as `var(--sp-shadow-*)` or `theme.json` token presets. Remove or justify anything else before merging.

## Spectre Icons integration

This theme is compatible with the [spectre-icons](https://wordpress.org/plugins/spectre-icons/) WordPress plugin. Once the plugin is installed and activated, the `[spectre-icon]` shortcode is available in any template or content area.

The theme footer automatically renders icon links when the plugin is active:

    [spectre-icon name="github" size="20"]
    [spectre-icon name="twitter" size="20"]
    [spectre-icon name="linkedin" size="20"]

To check availability before rendering icons in a custom template:

    <?php if (spectre_wordpress_themes_has_icons()) : ?>
        <?php echo do_shortcode('[spectre-icon name="arrow-right" size="16"]'); ?>
    <?php endif; ?>

This pattern works in both the classic editor and the block editor.

## Notes for implementers

- Keep PHP templates focused on structure, data access, and WordPress integration
- Keep theme styling and client behavior in src
- Treat the theme as the owner of its compiled CSS and JS bundles, not the owner of Spectre token or component definitions
- When in doubt, move reusable styling down into Spectre UI/components instead of expanding the WordPress shell

## License

MIT © PHCDevworks. See [LICENSE](LICENSE).
