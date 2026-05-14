# Spectre WordPress Themes Execution Todo

Aligned to `ROADMAP.md`. Scoped to WordPress.org submission readiness, block editor support, Spectre Icons integration, and CI/DX quality.

## Completed

- Restored design-system alignment across the WordPress shell
  - `src/styles/main.css` uses only `var(--sp-*)` tokens
  - PHP templates use semantic shell classes and WordPress APIs
  - `theme.json` layout settings consume Spectre layout tokens
- Added drift-prevention documentation in `AGENTS.md` and `README.md`
- Added `check:drift` npm script and CI step
- Added full PHP template hierarchy coverage
  - `index.php`, `single.php`, `page.php`, `archive.php`, `search.php`, `404.php`, `front-page.php`, `home.php`, `header.php`, `footer.php`, `sidebar.php`, `searchform.php`, `comments.php`
  - Template parts: `content-card.php`, `content-single.php`, `content-page.php`, `content-none.php`
- Integrated Spectre Icons plugin (`spectre_wordpress_themes_has_icons()` helper, footer social icons, search form pattern in README)
- Added Gutenberg block editor support (`add_theme_support('block-editor-styles')`, `enqueue_block_editor_assets`, `theme.json`)
- Added GitHub Actions CI pipeline (build, asset check, lint, PHP lint, drift check; Node matrix 22/24; PHP 8.2)
- Added WordPress smoke test workflow (real WP install, core route verification)
- Created `CLAUDE.md` — Claude Code project guide
- Synced versions across `package.json`, `style.css`, `readme.txt`
- Merged duplicate `.spectre-post-navigation` CSS rule in `main.css`

## P0: WordPress.org Submission Readiness

- Verify `readme.txt` passes WordPress.org theme review requirements
  - File targets: `spectre-theme/readme.txt`
  - Acceptance: All required sections present, no TGM Plugin Activation, license consistent
- Replace `screenshot.png` with a 1200×900px render of the theme's default appearance
  - File targets: `spectre-theme/screenshot.png`
  - Acceptance: Correct dimensions, reflects current default layout
- Run a full WordPress.org theme review compliance pass
  - Check for: no obfuscated code, correct license throughout, no calls to external resources without user consent
  - Use the Theme Check plugin against a live WordPress install

## P1: Developer Experience and Ecosystem Integration

- Document Elementor integration
  - File targets: `spectre-theme/functions.php`, `README.md`
  - Acceptance: Spectre UI CSS works in Elementor widget contexts; `spectre-icons` icon picker confirmed working; documented in README
- Add Elementor support hooks if needed (CSS scope compatibility)

## P2: Later / Controlled Improvement

- Evaluate Spectre Shell router (hash mode) for WordPress SPA pages
  - Document whether hash-based routing from `spectre-shell-router` is viable inside a WordPress page or custom template
  - Implement only if a concrete use case is proven
- Add child theme starter template
  - `spectre-init` can scaffold a child theme of this base
- Evaluate Beaver Builder support
  - Align with `spectre-icons` Beaver Builder roadmap timeline

## Explicitly Out of Scope

- Do not redefine token values or local design values
- Do not add PHP plugin logic (belongs in plugin repos like spectre-icons)
- Do not add WooCommerce templates without proven product need

## Recommended Execution Order

1. WordPress.org readme.txt compliance verification
2. screenshot.png replacement (1200×900px)
3. WordPress.org full review pass
4. Elementor integration
5. Shell router evaluation
6. Child theme starter
