# JPKCom Enable Argon2 – Developer Reference

## Plugin Overview

Switches WordPress password hashing to **Argon2id** by filtering `wp_hash_password_algorithm` to return `PASSWORD_ARGON2ID`. New and re-saved password hashes use Argon2id (requires a PHP build with libargon2 / `PASSWORD_ARGON2ID` support).

- **Text Domain:** none declared (defaults to slug `jpkcom-argon2`)
- **Min PHP:** 8.3 | **Min WP:** 6.9
- **Network:** `true` (can be network-activated)

---

## Architecture

```
Main file (jpkcom-argon2.php)
├── declare(strict_types=1)
├── Plugin header (Network: true)
├── JPKCOM_ARGON2_VERSION constant
├── init @ priority 5: boot JPKComGitPluginUpdater
└── add_filter wp_hash_password_algorithm → fn(): string => PASSWORD_ARGON2ID
```

Intentionally minimal: a single one-line filter plus the shared updater bootstrap. WordPress falls back to its default algorithm automatically if Argon2id is unavailable, but on PHP 8.3 it is expected to be present.

---

## Constants

| Constant | Value | Purpose |
|----------|-------|---------|
| `JPKCOM_ARGON2_VERSION` | `'2.0.2'` | Plugin version (sync with header/README/phpdoc.xml) |

---

## File Structure

```
jpkcom-argon2/
├── jpkcom-argon2.php             ← Main: header, constant, filter, updater bootstrap
├── includes/
│   └── class-plugin-updater.php  ← GitHub auto-updater (namespace: JPKComArgon2GitUpdate)
├── .github/workflows/release.yml ← Build ZIP, manifest, PHPDoc, deploy to gh-pages (on tag push)
├── phpdoc.xml                    ← phpDocumentor config
├── README.md                     ← Public readme (source for the WP plugin modal)
├── CLAUDE.md                     ← This file
├── LICENSE                       ← GPL-2.0-or-later
└── .gitignore
```

---

## Plugin Updater

- **Namespace:** `JPKComArgon2GitUpdate\JPKComGitPluginUpdater`
- **Manifest URL:** `https://jpkcom.github.io/jpkcom-argon2/plugin_jpkcom-argon2.json`
- Shared JPKCom updater (downstream copy of upstream `jpkcom-post-filter`; do not edit per-plugin). SHA256 verification, `wp_safe_remote_get()`, URL validation, race-condition lock, 24 h cache, timing-safe `hash_equals()`.
- Hooks: `plugins_api`, `site_transient_update_plugins`, `upgrader_process_complete`, `upgrader_pre_download`.

---

## Release Workflow

Triggered by **pushing a `v*` tag**; the workflow creates the GitHub release automatically. Pipeline: setup PHP/Python/Pandoc/GraphViz → README metadata → slug-named ZIP → SHA256 → upload ZIP + `.sha256` → `plugin_<slug>.json` manifest → PHPDoc → deploy to `gh-pages`.

---

## Security Checklist

- `declare(strict_types=1)` in every PHP file
- Single typed filter callback (`fn(): string`)
- Updater: SHA256 verification + URL validation (audited separately)

---

## Release Checklist

1. Bump version in: header `Version:` + `Stable tag:`, `JPKCOM_ARGON2_VERSION`, `README.md`, `phpdoc.xml`
2. Add a `### x.y.z` block to `## Changelog` in `README.md`
3. Commit, tag `vx.y.z`, push the tag → the workflow builds and publishes everything
