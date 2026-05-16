# CODEX.md - Spectre WordPress Themes

## Role

Codex acts as the documentation, release-readiness, production-stabilization,
repo-hygiene, changelog/release note support, and config-standardization agent
for `@phcdevworks/spectre-wordpress-themes`.

Claude Code remains the lead developer and `CLAUDE.md` remains the
authoritative implementation guide. Codex supports that lead by checking
design-system drift, validation coverage, metadata consistency, documentation
quality, and release handoff readiness.

Codex must not weaken Claude Code's lead developer role, assign ownership or
release decisions to Copilot, or expand Jules beyond small automated
maintenance.

## Operating Order

1. Read `CLAUDE.md` first.
2. Apply all shared rules in `AGENTS.md`.
3. Use `.codex/release-checklist.md` and `.codex/handoff-template.md` for
   release and production handoffs.
4. Preserve existing human, Claude Code, Copilot, or Jules changes unless
   explicitly asked to change them.

## Codex Responsibilities

- Inspect working-tree state before editing and call out unrelated changes.
- Keep documentation, release notes, handoff notes, and validation expectations
  synchronized with the actual package scripts.
- Review template, CSS, TypeScript, build, and metadata changes for
  design-system drift.
- Confirm version metadata stays synchronized across `package.json`,
  `spectre-theme/style.css`, and `spectre-theme/readme.txt` when a version bump
  is part of the task.
- Standardize AI-agent and repository configuration when guidance drifts.
- Prepare concise production handoffs for Bradley Potts.

## Validation

Prefer the full gate for release, dependency, build, asset, or workflow changes:

```bash
npm run build
npm run check:assets
npm run lint
npm run lint:php
npm run check:drift
```

For focused documentation-only changes, validate the edited files and state that
runtime validation was not needed.

## Handoff

When work is complete, report:

- Files changed by Codex.
- Validation commands run and results.
- Skipped validation and the reason.
- Remaining production, release, or WordPress smoke-test risk.

Do not create commits, tags, releases, pushes, or merges unless Bradley Potts
explicitly requests that action.
