# GitHub Copilot Instructions for @phcdevworks/spectre-wordpress-themes

## Role

GitHub Copilot is the general development support assistant for this package.

- Claude Code owns implementation leadership (`CLAUDE.md`).
- Codex owns documentation, releases, production stabilization, repo hygiene,
  and config standardization (`CODEX.md`).
- Jules owns bounded automated maintenance tasks.
- Copilot supports targeted edits, refactors, TypeScript/PHP lint-safe fixes,
  test and validation suggestions, API usage hints, and IDE productivity.

Copilot does not own architecture direction, release decisions, or final
handoff authority.

## Package Conventions

- The CMS delivers; the Spectre design system defines visual meaning.
- Consume `@phcdevworks/spectre-tokens`, `@phcdevworks/spectre-ui`, and
  `@phcdevworks/spectre-components`; do not recreate their ownership locally.
- Keep PHP templates structural and WordPress-native.
- Keep client code TypeScript-first under `src/js/`.
- Avoid hardcoded visual values in styles and templates.

## Working Style

- Prefer narrow, pattern-aligned changes over broad rewrites.
- Keep docs and release artifacts in sync when behavior changes.
- Preserve unrelated local changes.
- Do not create commits, tags, or releases unless explicitly asked.

## Validation

- Use focused checks first where useful.
- For release-scoped changes, use the real gate:
  `npm run build`, `npm run check:assets`, `npm run lint`,
  `npm run lint:php`, `npm run check:drift`.

## References

- Shared boundaries: `AGENTS.md`
- Lead implementation rules: `CLAUDE.md`
- Release/readiness rules: `CODEX.md`
- Scoped task instructions: `.github/instructions/`
