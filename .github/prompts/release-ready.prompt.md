---
name: 'Release Ready'
description: 'Audit the current diff or a named scope for production readiness, validation coverage, metadata drift, and handoff quality.'
argument-hint: 'Describe the scope to audit, or leave blank to use the current diff'
agent: 'production-steward'
---

Audit the requested scope for production readiness.

- Start with [AGENTS.md](../../AGENTS.md), [CLAUDE.md](../../CLAUDE.md), and [.codex/release-checklist.md](../../.codex/release-checklist.md).
- Inspect the working tree before editing and preserve unrelated changes.
- Verify validation coverage against the scripts in [package.json](../../package.json).
- Standardize any stale documentation or GitHub checklist items only when they are directly relevant to the scoped change.
- Return the result using the structure in [.codex/handoff-template.md](../../.codex/handoff-template.md).
