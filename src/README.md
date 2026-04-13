# Source Files

This directory contains the theme-owned frontend source files.

## Core files

- "js/main.ts" is the single theme JavaScript entry.
- "styles/main.css" is the theme stylesheet source imported by "js/main.ts".

## Workflow

- Edit files in "src/" during development.
- Run "npm run dev" for the Vite dev server and HMR.
- Run "npm run build" to emit compiled assets into "spectre-theme/dist/".

## Boundaries

- "src/" is the source of truth for theme CSS and JavaScript.
- "spectre-theme/dist/" is build output and should not be edited manually.
- Spectre UI is imported from "@phcdevworks/spectre-ui/index.css" in "styles/main.css".
