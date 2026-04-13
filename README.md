# @phcdevworks/spectre-wordpress-themes

[![GitHub issues](https://img.shields.io/github/issues/phcdevworks/spectre-wordpress-themes)](https://github.com/phcdevworks/spectre-wordpress-themes/issues)
[![GitHub pull requests](https://img.shields.io/github/issues-pr/phcdevworks/spectre-wordpress-themes)](https://github.com/phcdevworks/spectre-wordpress-themes/pulls)
[![License](https://img.shields.io/github/license/phcdevworks/spectre-wordpress-themes)](LICENSE)

`@phcdevworks/spectre-wordpress-themes` is a reusable template for building modern, high-performance WordPress themes.

Maintained by PHCDevworks as part of the Spectre suite, it acts as the "Organs" layer (Layer 6), providing the CMS-specific structure and integration logic. The package bridges modern frontend tooling (Vite, TypeScript, Tailwind CSS 4) with the WordPress theme hierarchy, ensuring Spectre standards are strictly maintained in a CMS environment.

This package's source repository is hosted at
[`phcdevworks/spectre-wordpress-themes`](https://github.com/phcdevworks/spectre-wordpress-themes).

## Key capabilities

- Vite-powered development with instant HMR
- TypeScript for type-safe client-side theme development
- Tailwind CSS 4 with modern `@import` syntax
- Automatic dev/prod mode detection via `WP_ENV`
- Manifest-based asset loading with reliable cache-busting
- WordPress-optimized build output directly to `spectre-theme/dist/`

## Installation

Clone or use this template to start a new WordPress theme:

```bash
git clone https://github.com/phcdevworks/spectre-wordpress-themes.git
cd spectre-wordpress-themes
npm install
```

## Quick start

### 1. Configure WordPress Environment

Set up your WordPress installation `wp-config.php` to work with the Vite dev server:

```php
define('WP_ENV', 'development'); // Enable dev mode
```

### 2. Start Development Server

```bash
npm run dev
```

This starts the Vite dev server with HMR enabled. Edit files in `src/` and see changes instantly.

### 3. Activate Theme in WordPress

Link or copy the theme folder to your WordPress installation:

```bash
ln -s $(pwd)/spectre-theme /path/to/wordpress/wp-content/themes/spectre-theme
```

Then activate the theme in the WordPress admin panel.

### 4. Build for Production

```bash
npm run build
```

This compiles TypeScript, processes CSS, generates optimized assets, and creates a manifest in `spectre-theme/dist/`. Upload the `spectre-theme/` folder to your production environment.

## What this package owns

- Vite build pipeline for WordPress theme assets
- Tailwind CSS 4 configuration and processing
- `functions.php` integration for loading correct dev/prod assets
- Basic WordPress template structure (`index.php`, `header.php`, `footer.php`, etc.)
- Manifest-based cache-busting implementation for WordPress

## What this package does not own

- Core UI components (owned by `@phcdevworks/spectre-ui`)
- Design tokens or color definitions (owned by `@phcdevworks/spectre-tokens`)
- WordPress core setup, database management, or hosting configuration
- General state management or reactive primitives (owned by `@phcdevworks/spectre-signals`)

The CMS delivers; the Arsenal defines. This package is strictly legacy-forbidden from redefining design tokens or hardcoding hex colors.

## Relationship to the rest of Spectre

Spectre keeps responsibilities separate using a strict 8-Layer Arsenal hierarchy:

- `@phcdevworks/spectre-tokens` (Layer 1: DNA) owns visual language, semantic roles, and token contracts
- `@phcdevworks/spectre-ui` (Layer 2: Blueprint) owns token-driven styling, Tailwind helpers, and class recipes
- `@phcdevworks/spectre-shell` owns thin shell composition and runtime surface
- `@phcdevworks/spectre-shell-router` owns URL resolution and navigation primitives
- `@phcdevworks/spectre-signals` owns reactive primitives only
- `@phcdevworks/spectre-wordpress-themes` (Layer 6: Organs) owns CMS integration and theme delivery

That separation keeps the tokens and UI components portable and prevents the WordPress integration from defining design logic.

## Development

Install dependencies, then run the standard scripts:

```bash
npm run dev    # Start Vite with HMR
npm run build  # Build production assets
```

Key source areas:

- `src/js/main.ts` – Main client script entry point
- `src/styles/main.css` – Tailwind and styling entry point
- `spectre-theme/functions.php` – Asset enqueuing logic
- `vite.config.ts` – Vite build and manifest settings
- `tailwind.config.ts` – Tailwind content and preset configuration

## Contributing

When contributing:

- keep the PHP templates focused on structure and data fetching
- prefer implementation clarity over abstraction-heavy design
- avoid redefining design tokens or colors directly in the theme
- ensure `npm run build` succeeds and produces the `.vite/manifest.json` before opening a pull request

Standard WordPress coding guidelines apply to PHP files. Scope discipline is part of the package contract. See [CONTRIBUTING.md](CONTRIBUTING.md) for detailed guidelines.

## License

MIT © PHCDevworks. See [LICENSE](LICENSE).



