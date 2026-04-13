# @phcdevworks/spectre-wordpress-themes

[![GitHub issues](https://img.shields.io/github/issues/phcdevworks/spectre-wordpress-themes)](https://github.com/phcdevworks/spectre-wordpress-themes/issues)
[![GitHub pull requests](https://img.shields.io/github/issues-pr/phcdevworks/spectre-wordpress-themes)](https://github.com/phcdevworks/spectre-wordpress-themes/pulls)
[![License](https://img.shields.io/github/license/phcdevworks/spectre-wordpress-themes)](LICENSE)

@phcdevworks/spectre-wordpress-themes is a high-performance theme foundation for WordPress based sites. It combines a standard WordPress theme directory with a Vite build pipeline, a TypeScript client entrypoint, and Tailwind CSS so teams can build theme-owned assets with a modern frontend workflow and deliver them through WordPress.

This repository is for developers building custom WordPress themes that need to stay aligned with Spectre tokens and Spectre UI without moving design-system ownership into PHP templates.

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

This repository is where those frontend foundations are delivered through a WordPress theme. The theme should consume Spectre tokens and Spectre UI output, not redefine them.

By default, the theme stylesheet imports the Spectre UI default bundle, so a fresh install starts from Spectre UI instead of a generic Tailwind-only baseline.

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

3. Make the theme available to WordPress by linking or copying spectre-theme into wp-content/themes.

4. Ensure your WordPress environment is running in development mode so the theme loads assets from the Vite dev server. This repo checks wp_get_environment_type() first and falls back to WP_ENV set to development.

5. Build production assets when needed.

    npm run build

The production build writes hashed assets and .vite/manifest.json to spectre-theme/dist, and the theme uses that manifest to enqueue the compiled files.

## Notes for implementers

- Keep PHP templates focused on structure, data access, and WordPress integration
- Keep theme styling and client behavior in src
- Treat the theme as the owner of its compiled CSS and JS bundles, not the owner of Spectre token or component definitions

## License

MIT © PHCDevworks. See [LICENSE](LICENSE).
