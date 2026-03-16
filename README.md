# @phcdevworks/spectre-shell-wordpress

### **The WordPress Shell (Layer 6 of the Spectre 8-Layer Arsenal)**

`@phcdevworks/spectre-shell-wordpress` is a reusable template for building modern, high-performance WordPress themes. It acts as the "Organs" layer, providing the CMS-specific structure and integration logic for the Spectre ecosystem.

🤝 **[Contributing Guide](CONTRIBUTING.md)** | 📝 **[Changelog](CHANGELOG.md)** | 🏛️ **[Spectre Arsenal](https://github.com/phcdevworks)**

---

## 🏗️ Core Architecture

This package is the **CMS Integration Layer**. It bridges modern frontend tooling (Vite, TS, Tailwind 4) with the WordPress theme hierarchy, ensuring Spectre standards are maintained in a CMS environment.

- 🐘 **WordPress Native**: Full support for standard PHP templates and functions.
- ⚡ **Vite-Powered**: Instant HMR and optimized production builds.
- 🌫️ **Manifest-Based Assets**: Reliable cache-busting and asset loading.
- 🎨 **Tailwind 4 Ready**: Pre-configured for the latest utility-first styling.

---

- ✅ Vite-powered development with instant HMR
- ✅ TypeScript for type-safe theme development
- ✅ Tailwind CSS 4 with modern `@import` syntax
- ✅ Automatic dev/prod mode detection via `WP_ENV`
- ✅ Manifest-based asset loading with cache-busting
- ✅ WordPress-optimized build output to `spectre-theme/dist/`

## Installation

```bash
# Clone or use this template
git clone https://github.com/phcdevworks/spectre-shell-wordpress.git
cd spectre-shell-wordpress

# Install dependencies
npm install
```

## Usage

### 1. Configure WordPress Environment

Set up your WordPress installation to work with the Vite dev server:

```php
// wp-config.php
define('WP_ENV', 'development'); // Enable dev mode
```

**How it works:**

- **Development mode**: Assets load from Vite dev server (http://localhost:5173) with HMR
- **Production mode**: Assets load from `spectre-theme/dist/` with manifest-based cache-busting

### 2. Start Development Server

```bash
npm run dev
```

This starts the Vite dev server on http://localhost:5173 with HMR enabled. Edit files in `src/` and see changes instantly in your browser.

### 3. Activate Theme in WordPress

```bash
# Copy or symlink theme folder to WordPress
cp -r spectre-theme /path/to/wordpress/wp-content/themes/spectre-theme
# Or create a symlink for development
ln -s $(pwd)/spectre-theme /path/to/wordpress/wp-content/themes/spectre-theme
```

Then activate the theme in WordPress admin.

### 4. Build for Production

```bash
npm run build
```

This compiles TypeScript, processes CSS with Tailwind, and outputs optimized assets to `spectre-theme/dist/` with a manifest for cache-busting.

**Deploy:** Upload the `spectre-theme/` folder to your WordPress installation.

## Theme Customization

### Update Theme Metadata

Edit `spectre-theme/style.css` with your theme details:

```css
/*
Theme Name: Your Theme Name
Theme URI: https://yoursite.com
Author: Your Name
Description: Your amazing WordPress theme
Text Domain: your-theme-slug
*/
```

### Replace Function Prefixes

Find and replace in `spectre-theme/functions.php`:

- `spectre_shell` → `your_theme_slug`
- Function names (e.g., `spectre_shell_setup` → `yourtheme_setup`)

### Customize Styles

Edit `src/styles/main.css`:

```css
@import "tailwindcss";

/* Your custom styles */
:root {
  --font-sans: system-ui, sans-serif;
}

body {
  @apply antialiased;
}

/* WordPress alignment classes */
.alignleft {
  @apply float-left mr-4;
}
```

### Add JavaScript

Edit `src/js/main.ts`:

```typescript
import "../styles/main.css";

// Your TypeScript code
document.addEventListener("DOMContentLoaded", () => {
  console.log("Theme loaded!");
});
```

### Tailwind Configuration

Customize `tailwind.config.ts`:

```typescript
import type { Config } from "tailwindcss";

export default {
  content: ["./spectre-theme/**/*.php", "./src/**/*.{js,ts,jsx,tsx}"],
  theme: {
    extend: {
      colors: {
        primary: "#your-color",
      },
    },
  },
} satisfies Config;
```

## Project Structure

| Folder                | Responsibility                                                       |
| --------------------- | -------------------------------------------------------------------- |
| `src/`                | TypeScript and CSS source files compiled by Vite                     |
| `src/js/`             | JavaScript/TypeScript entry points                                   |
| `src/styles/`         | CSS files with Tailwind imports                                      |
| `spectre-theme/`      | WordPress theme files (PHP templates, functions.php, style.css)      |
| `spectre-theme/dist/` | Generated build artifacts (CSS, JS, manifest) - auto-created by Vite |

**Source files** live in `src/` and compile to `spectre-theme/dist/`. Only the `spectre-theme/` folder gets deployed to WordPress.

## Asset Loading

### Development Mode

When `WP_ENV` is set to `development`, `spectre-theme/functions.php` loads assets from the Vite dev server:

```php
wp_enqueue_script(
    'vite-client',
    'http://localhost:5173/@vite/client',
    array(),
    null,
    false
);
```

Changes to source files trigger instant browser updates via HMR.

### Production Mode

In production, assets load from the manifest file at `spectre-theme/dist/.vite/manifest.json`:

```php
$manifest = json_decode(file_get_contents(get_template_directory() . '/dist/.vite/manifest.json'), true);

if (isset($manifest['src/styles/main.css'])) {
    $css_file = $manifest['src/styles/main.css']['file'];
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/dist/' . $css_file);
}
```

Hashed filenames ensure cache-busting on updates.

## WordPress Theme Templates

Add standard WordPress templates to the `spectre-theme/` folder:

```
spectre-theme/
├── single.php       # Single post template
├── page.php         # Page template
├── archive.php      # Archive template
├── 404.php          # 404 error page
├── search.php       # Search results
└── sidebar.php      # Sidebar
```

All templates have access to enqueued Vite assets automatically.

## Build & Release

```bash
npm run build
```

The build process:

1. **TypeScript compilation** - Compiles `src/js/` to optimized JavaScript
2. **CSS processing** - Processes `src/styles/` with Tailwind and PostCSS
3. **Asset optimization** - Minifies and generates hashed filenames
4. **Manifest generation** - Creates `.vite/manifest.json` for asset lookup

Output goes to `spectre-theme/dist/` and is ready for WordPress deployment.

For release history and version notes, see the **[Changelog](CHANGELOG.md)**.

## Development Philosophy

This template follows a **build tool first** approach:

### 1. Build Configuration (Vite + Tailwind)

**Purpose**: Asset compilation pipeline for WordPress themes

**Outputs**: Compiled CSS and JavaScript to `spectre-theme/dist/` with manifest

**Rules**:

- Vite handles all asset compilation and HMR
- Tailwind provides utility-first CSS framework
- All source files must go through Vite

### 2. Source Assets (src/)

**Purpose**: Development files for TypeScript and CSS

**Contains**:

- `main.ts` - JavaScript entry point
- `main.css` - CSS entry with Tailwind imports
- Optional component organization

**Rules**:

- Use TypeScript for type safety
- Import Tailwind via `@import 'tailwindcss'`
- Never ship raw source to production

### 3. WordPress Theme (spectre-theme/)

**Purpose**: WordPress templates and functions that load Vite assets

**Key mechanism**:

- `functions.php` detects `WP_ENV` and switches between dev/prod
- Dev mode loads from Vite server with HMR
- Prod mode loads from manifest

**Rules**:

- PHP never defines inline styles or scripts
- All assets load through Vite's build system
- Follow WordPress coding standards

### Golden Rule (Non-Negotiable)

**Vite builds. WordPress loads. Source never ships.**

WordPress themes ship only compiled assets from `dist/`, never raw source files.

- If it's a build config → belongs in `vite.config.ts` or `tailwind.config.ts`
- If it's source code → belongs in `src/`
- If it's WordPress PHP → belongs in `spectre-theme/`

## Design Principles

1. **Fast development** - HMR and Vite dev server for instant feedback
2. **Type-safe** - TypeScript catches errors before runtime
3. **Modern CSS** - Tailwind CSS 4 with utility-first approach
4. **WordPress-native** - Standard WordPress functions and hooks
5. **Production-ready** - Optimized builds with cache-busting

## TypeScript Support

Type definitions are included for Vite and WordPress globals:

```typescript
// vite-env.d.ts
/// <reference types="vite/client" />

interface ImportMetaEnv {
  readonly VITE_SOME_KEY: string;
}

interface ImportMeta {
  readonly env: ImportMetaEnv;
}
```

---

## 🏛️ The Spectre Suite Hierarchy

Spectre is built on a non-negotiable hierarchy to prevent style leakage and duplication:

1.  **Layer 1: DNA** ([@phcdevworks/spectre-tokens](https://github.com/phcdevworks/spectre-tokens)) – Design values.
2.  **Layer 2: Blueprint** ([@phcdevworks/spectre-ui](https://github.com/phcdevworks/spectre-ui)) – Structure & Recipes.
3.  **Layer 6: Organs (This Package)** – CMS Integration & Themes.

> **The Golden Rule**: Tokens define *meaning*. UI defines *structure*. Organs define *delivery* for specific engines like WordPress.

---

## Contributing

Issues and pull requests are welcome. For theme template improvements, test both dev and production modes.

For detailed contribution guidelines, see **[CONTRIBUTING.md](CONTRIBUTING.md)**.

## License

MIT © PHCDevworks — See **[LICENSE](LICENSE)** for details.

---


