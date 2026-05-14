# Agent Instructions: @phcdevworks/spectre-wordpress-themes

## Primary AI Developer

**Claude Code** (`claude-sonnet-4-6`) is the designated primary AI developer for
this repository, maintained on behalf of Bradley Potts
(brad.potts@coastdigitalgroup.com) at PHCDevworks. All development is driven
through Claude Code operating from `CLAUDE.md` as the authoritative working
guide. Human final review and commit authority rests with Bradley Potts.

Claude Code does not create git commits. Changes are prepared and validated,
then handed off for human review and commit.

This file provides supplementary instructions for any additional AI agents working
in this repository. The canonical guidance lives in `CLAUDE.md`.

## The Golden Rule

**The CMS delivers; the design system defines.** Never redefine design tokens, hardcode hex colors, or create UI components in PHP. All visual decisions belong to `@phcdevworks/spectre-tokens`, `@phcdevworks/spectre-ui`, and `@phcdevworks/spectre-components`. This theme consumes them.

## Core Directives

1. **Token consumption only.** CSS in `src/styles/` references Spectre tokens exclusively via CSS variables (`var(--sp-*)`) or the official Tailwind preset. No hardcoded values.
2. **Use the component system.** Use `<sp-button>`, `<sp-input>`, and other web components from `@phcdevworks/spectre-components` in templates instead of hand-rolling styled elements.
3. **Environment awareness.** Respect `WP_ENV` / `wp_get_environment_type()`. Development loads from the Vite dev server. Production reads from the hashed manifest in `dist/`.
4. **TypeScript only.** All client-side logic in `src/js/` uses TypeScript.
5. **PHP templates are structural.** PHP files handle WordPress integration, template hierarchy, and data access. They do not own visual decisions.
6. **Theme metadata integrity.** Keep the `style.css` header valid and version-synced with `package.json` and `spectre-theme/readme.txt`.

## Drift Prevention

Before adding or changing visual UI, ask where the responsibility belongs:

- **Spectre tokens** define values: color, type, spacing, radius, shadow, motion, breakpoints, and layout scales.
- **Spectre UI/components** define reusable styling contracts and component behavior.
- **This theme** defines only WordPress shell structure and theme-specific composition needed to deliver Spectre through WordPress.

Allowed in PHP templates:

- WordPress template hierarchy, loops, conditionals, navigation, metadata, and data escaping
- Semantic shell classes such as `spectre-site-container`, `spectre-main`, `spectre-panel`, and `spectre-card`
- Spectre web components such as `<sp-button>` and `<sp-input>`

Avoid in PHP templates:

- Tailwind presentation utilities for color, type, spacing, radius, shadow, or layout decisions
- Hardcoded CSS values or arbitrary utilities such as `text-white`, `rounded-*`, `shadow-*`, `tracking-*`, `p-*`, `px-*`, `py-*`, `gap-*`, `space-y-*`, `max-w-*`, `w-*`, or `h-*`
- Hand-built controls when an `<sp-*>` component exists

Allowed in `src/styles/main.css`:

- Imports for Tailwind, Spectre tokens, and Spectre UI
- Theme shell selectors that map WordPress structure to Spectre token variables
- CSS values derived from `var(--sp-*)`

Avoid in `src/styles/main.css`:

- Hex, RGB/HSL/OKLCH, gradients, pixel/rem/em constants, or local design values
- New design-token definitions
- Component styling that should live in `@phcdevworks/spectre-ui` or `@phcdevworks/spectre-components`

If a new visual pattern feels reusable outside this WordPress shell, do not define it here permanently. Add the smallest token-driven bridge needed for the theme, then note that the pattern should graduate into `@phcdevworks/spectre-ui`.

## Dependency Contracts

| Package | Role | How to consume |
|---|---|---|
| `@phcdevworks/spectre-tokens` | Design tokens | Import `index.css` for CSS vars; use JS exports for tooling |
| `@phcdevworks/spectre-ui` | Styles and recipes | Import `index.css`; use recipe functions (`getButtonClasses` etc.) where web components aren't available |
| `@phcdevworks/spectre-components` | Web components | Register via `defineSpectreComponents()` in `src/js/main.ts`; use `<sp-*>` elements in templates |

When any of these packages updates, run `npm install`, rebuild, and verify the theme still renders correctly.

## Validation

- `npm run build` — must succeed cleanly
- `npm run check:assets` — validates manifest and asset contract
- `npm run check:drift` — scans for design-system drift (hardcoded visual values)
- `npm run lint` — TypeScript and ESLint
- `npm run lint:php` — PHP syntax validation
- CI runs all of the above on every push and PR

Run this drift scan before handing off visual/template changes:

```bash
npm run check:drift
```

Expected results should be either empty or token-backed references such as `var(--sp-shadow-*)` and `theme.json` token presets. Any local visual value needs to be removed or justified in the handoff.
