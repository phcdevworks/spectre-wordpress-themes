import { readFile } from 'node:fs/promises'
import { resolve } from 'node:path'

interface ViteManifestEntry {
  css?: string[]
  file?: string
}

const manifestPath = resolve('spectre-theme/dist/.vite/manifest.json')
const entryKey = 'src/js/main.ts'

const manifest = JSON.parse(await readFile(manifestPath, 'utf8')) as Record<
  string,
  ViteManifestEntry
>
const mainEntry = manifest[entryKey]

if (!mainEntry || typeof mainEntry !== 'object') {
  throw new Error(`Missing manifest entry for ${entryKey}`)
}

if (typeof mainEntry.file !== 'string' || !mainEntry.file.endsWith('.js')) {
  throw new Error(`Expected ${entryKey} to emit one JavaScript file`)
}

if (!Array.isArray(mainEntry.css) || mainEntry.css.length !== 1) {
  throw new Error(
    `Expected ${entryKey} to emit exactly one CSS file, received ${Array.isArray(mainEntry.css) ? mainEntry.css.length : 0}`
  )
}

const [cssFile] = mainEntry.css

if (!cssFile?.endsWith('.css')) {
  throw new Error(`Expected ${entryKey} CSS asset to end with .css`)
}

console.log(
  JSON.stringify(
    {
      entry: entryKey,
      js: mainEntry.file,
      css: cssFile,
    },
    null,
    2
  )
)
