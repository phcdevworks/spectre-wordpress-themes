---
name: 'Handoff Note'
description: 'Produce a Bradley-ready handoff summary from the current diff, including validation status, release readiness, and remaining risk.'
argument-hint: 'Describe the scope, reviewer, or release context'
agent: 'production-steward'
---

Prepare a clean handoff note for the current diff or requested scope.

- Use [.codex/handoff-template.md](../../.codex/handoff-template.md) as the output structure.
- Summarize only the files and behaviors that matter for review.
- List validation that ran, validation that was skipped, and why.
- Call out design-system drift risk, WordPress test gaps, or version-sync gaps when present.
- Keep the final handoff concise and ready for human review.
