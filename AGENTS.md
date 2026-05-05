# Agent Instructions: @phcdevworks/spectre-wordpress-themes

This project is the **WordPress Shell** — a bridge between modern frontend tooling and the WordPress theme ecosystem. Its job is to deliver the Spectre design system through a WordPress theme, not to redefine it.

## The Golden Rule

**The CMS delivers; the design system defines.** Never redefine design tokens, hardcode hex colors, or create UI components in PHP. All visual decisions belong to `@phcdevworks/spectre-tokens`, `@phcdevworks/spectre-ui`, and `@phcdevworks/spectre-components`. This theme consumes them.

## Core Directives

1. **Token consumption only.** CSS in `src/styles/` references Spectre tokens exclusively via CSS variables (`var(--sp-*)`) or the official Tailwind preset. No hardcoded values.
2. **Use the component system.** Use `<sp-button>`, `<sp-input>`, and other web components from `@phcdevworks/spectre-components` in templates instead of hand-rolling styled elements.
3. **Environment awareness.** Respect `WP_ENV` / `wp_get_environment_type()`. Development loads from the Vite dev server. Production reads from the hashed manifest in `dist/`.
4. **TypeScript only.** All client-side logic in `src/js/` uses TypeScript.
5. **PHP templates are structural.** PHP files handle WordPress integration, template hierarchy, and data access. They do not own visual decisions.
6. **Theme metadata integrity.** Keep the `style.css` header valid for WordPress theme recognition.

## Dependency Contracts

| Package | Role | How to consume |
|---|---|---|
| `@phcdevworks/spectre-tokens` | Design tokens | Import `index.css` for CSS vars; use JS exports for tooling |
| `@phcdevworks/spectre-ui` | Styles and recipes | Import `index.css`; use recipe functions (`getButtonClasses` etc.) where web components aren't available |
| `@phcdevworks/spectre-components` | Web components | Register via `defineSpectreComponents()` in `src/js/main.ts`; use `<sp-*>` elements in templates |

When any of these packages updates, run `npm install`, rebuild, and verify the theme still renders correctly.

## What this repo owns

- `vite.config.ts` — build and dev server configuration
- `src/js/main.ts` — theme JavaScript entrypoint
- `src/styles/main.css` — theme CSS entrypoint
- `spectre-theme/` — WordPress theme files (PHP templates, `style.css`, `functions.php`, `theme.json`)
- `spectre-theme/dist/` — compiled build output (never edit directly)

## What this repo does not own

- Design token values
- Component visual contracts
- WordPress core, plugin management, or hosting

## Validation

- `npm run build` — must succeed cleanly
- `npm run check:assets` — validates manifest and asset contract
- `npm run lint` — TypeScript and ESLint
- `npm run lint:php` — PHP syntax validation
- CI runs all of the above on every push and PR
