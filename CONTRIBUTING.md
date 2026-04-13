# Contributing to Spectre WordPress Themes

Thanks for helping improve Spectre WordPress Themes! This package is a reusable template for building modern WordPress themes with Vite, TypeScript, and Tailwind CSS 4.

## 🏛️ Spectre Design Philosophy

Spectre is a **specification-driven design system** built on a strict hierarchy:

### 1. @phcdevworks/spectre-tokens (Layer 1 - DNA)
- **Purpose**: Single source of truth for design values (colors, spacing, typography, semantic roles).
- **Rules**: Defines semantic meaning, not UI behavior. Designers own JSON; engineers maintain transforms.

### 2. @phcdevworks/spectre-ui (Layer 2 - The Blueprint)
- **Purpose**: Converts tokens into real CSS and class recipes.
- **Rules**: MUST consume tokens, MUST NOT redefine values. Every CSS selector has a matching recipe.

### 3. Framework Adapters (Layer 3 - Delivery)
- **Purpose**: Map Layer 2 to specific frameworks (WordPress, Astro, etc.).
- **Rules**: Adapters never define styles or duplicate CSS.

> **The Golden Rule**: Tokens define *meaning*. UI defines *structure*. Adapters define *delivery*.

---

## Development Philosophy

This template follows a **build tool first** approach:

### 1. Build Configuration (Vite + Tailwind)

**Purpose**: Single source of truth for asset compilation and optimization

**Exports**: Compiled CSS and JavaScript to `spectre-theme/dist/` with manifest

**Rules**:

- Vite config defines asset pipeline and WordPress integration
- Tailwind config defines design utilities and theme
- All source files compile through Vite

**Status**: v0.0.1 initial template release with dev/prod mode detection and HMR support

### 2. Source Assets (src/)

**Purpose**: Development files for TypeScript and CSS

**Ships**:

- `main.ts` (JavaScript entry point)
- `main.css` (CSS entry with Tailwind)
- Optional token/component organization

**Rules**:

- Keep source minimal and well-documented
- Import Tailwind via `@import` syntax
- Use TypeScript for type safety

**Status**: Basic structure ready for customization

### 3. WordPress Theme (spectre-theme/)

**Purpose**: WordPress templates and PHP functions that load Vite assets

**Key mechanism**:

- `functions.php` detects `WP_ENV` to switch dev/prod modes
- Dev mode loads from Vite server with HMR
- Prod mode loads manifest-based compiled assets

**Rules**:

- PHP never defines styles or scripts inline
- All assets load through Vite's manifest or dev server
- Follow WordPress coding standards

**Status**: Basic templates with asset loading ready

### Golden Rule (Non-Negotiable)

**Vite builds. WordPress loads. Source never ships.**

WordPress themes never ship raw source files—only compiled assets from `dist/`.

- If it's a build config → belongs in `vite.config.ts` or `tailwind.config.ts`
- If it's source code → belongs in `src/`
- If it's WordPress PHP → belongs in `spectre-theme/`

## Development Setup

1. Clone the repository:

```bash
git clone https://github.com/phcdevworks/spectre-wordpress-themes.git
cd spectre-wordpress-themes
```

2. Install dependencies:

```bash
npm install
```

3. Build the package (compiles TypeScript and generates CSS):

```bash
npm run build
# or for development with watch mode:
npm run dev
```

## Project Structure

```
spectre-wordpress-themes/
├── src/
│   ├── js/
│   │   └── main.ts          # JavaScript entry point
│   └── styles/
│       └── main.css         # CSS entry with Tailwind
├── spectre-theme/
│   ├── dist/                # Built assets (generated)
│   ├── functions.php        # Theme functions & asset loading
│   ├── header.php           # Header template
│   ├── footer.php           # Footer template
│   ├── index.php            # Main template
│   └── style.css            # WordPress theme metadata
├── vite.config.ts           # Vite configuration
├── tailwind.config.ts       # Tailwind configuration
└── package.json
```

**Responsibilities**:

- **Theme developers**: Edit `spectre-theme/` templates and `src/` assets
- **Config maintainers**: Update Vite and Tailwind configs
- **Build engineers**: Update build pipeline when structure changes

## Contribution Guidelines

### Configuration Development

1. **Never hardcode paths** – Use Node.js path resolution
2. **Test both modes** – Verify dev server and production builds
3. **Document changes** – Update README when config changes
4. **Keep it minimal** – Only include necessary options

### Source File Development

- Use TypeScript for type safety
- Follow modern ES module patterns
- Add comments for complex logic
- Import Tailwind properly with `@import 'tailwindcss'`
- Test in dev mode with HMR

### WordPress Theme Development

- Follow WordPress coding standards for PHP
- Never inline styles or scripts
- Use proper escaping and sanitization
- Test theme activation and asset loading
- Ensure compatibility with latest WordPress version

### Code Quality

- Use modern TypeScript + ES modules
- Follow WordPress PHP standards
- Add comments for complex logic
- Run `npm run build` before committing
- Test changes in both dev and prod modes

### Documentation

- Update README.md when adding features
- Include code examples for new features
- Document breaking changes in commit messages
- Keep inline comments clear and concise

## Pull Request Process

1. **Branch from `main`**
2. **Make your changes** and test locally (`npm run build` and verify in WordPress)
3. **Run build** to ensure compilation works (`npm run build`)
4. **Update documentation** (README.md, comments) to reflect changes
5. **Open a PR** describing:
   - The motivation for the change
   - What was changed
   - Testing notes (WordPress version, dev/prod modes tested)
6. **Respond to feedback** and make requested changes

## Known Gaps (Not Done Yet)

- Additional WordPress template files (single.php, page.php, archive.php)
- WordPress block editor (Gutenberg) styles and support
- Image optimization pipeline
- Multi-language/i18n setup examples
- Custom post type examples
- WooCommerce integration example

## Questions or Issues?

Please open an issue or discussion on GitHub if you're unsure about the best approach for a change. Coordinating early avoids conflicts with:

- Build configuration
- WordPress compatibility
- Template structure

## Code of Conduct

This project adheres to the [Code of Conduct](CODE_OF_CONDUCT.md). By participating, you are expected to uphold this code. Please report unacceptable behavior to the project maintainers.

## License

By contributing, you agree that your contributions will be licensed under the MIT License.
