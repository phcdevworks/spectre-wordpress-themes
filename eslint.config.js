import tseslint from "@typescript-eslint/eslint-plugin"
import tsParser from "@typescript-eslint/parser"

export default [
  {
    ignores: ["node_modules/**", "spectre-theme/dist/**"]
  },
  {
    files: ["**/*.{ts,tsx,js,jsx}"],
    languageOptions: {
      parser: tsParser,
      ecmaVersion: "latest",
      sourceType: "module",
      globals: {
        window: "readonly",
        document: "readonly",
        console: "readonly",
        module: "readonly",
        process: "readonly"
      }
    },
    plugins: {
      "@typescript-eslint": tseslint
    },
    rules: {
      ...tseslint.configs.recommended.rules,
      "no-console": "warn",
      "@typescript-eslint/no-unused-vars": [
        "warn",
        {
          argsIgnorePattern: "^_"
        }
      ],
      "@typescript-eslint/no-explicit-any": "warn"
    }
  }
]
