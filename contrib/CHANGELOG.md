# Changelog

## 2.1.0 22/09/2026
  - [NEW] Added a full EPV/unit/functional/smoke/integration test suite (#6)
  - [NEW] Added `specialization_provider_interface` (no-op: Final Fantasy XIV jobs are already terminal, no sub-spec layer to seed) (#7)
  - [FIX] Various CI/test fixture fixes surfaced while adding the new suite (smallint overflow, login-vs-disable_ext ordering, fixture missing its `bb_ranks` row, guild fixture missing its portal module row, missing `bb_portal_tabs` seed row in the guild-view functional fixture)
  - [FIX] `cleanup.sql`: stale `bbguild_ffxiv` naming and a wrong column name
  - [FIX] `depends_on()` pointed at a bbguild core migration removed by core's migration squash
  - [FIX] Unit test broken by the language-service migration
  - [FIX] `composer.json`: wrong homepage URL, missing `require-dev`
  - [CHG] Deprecated `sql_nextid()`/`add_lang_ext()` calls replaced with `sql_last_inserted_id()`/the language service
  - [CHG] Core version pairing bumped to `>=2.1.0`
  - [NEW] Added community health files (CoC, security policy, contributing guide, templates)
  - [NEW] Added a docs site (MkDocs + GitHub Pages)

## 2.0.0-rc2 25/07/2026
  - [NEW] Added all 11 post-A-Realm-Reborn jobs (Heavensward through Dawntrail): Dark Knight, Astrologian, Machinist, Red Mage, Samurai, Gunbreaker, Dancer, Sage, Reaper, Viper, Pictomancer — with en/fr/de names.
  - [CHG] Bumped every job's level cap 50 → 100 (current Dawntrail cap).
  - [DOCS] Updated the class table and removed the obsolete "Known Limitations" section (races and Grand Companies were already complete). (#2)

## 2.0.0-rc1 24/07/2026
  - [FIX] Migration dependency pointed at a since-removed bbguild core migration path (`basics\schema`, squashed into `v200b3` in an earlier core release) — this plugin could not install at all against current core
  - [FIX] `get_table_names()` was missing `bb_specializations_table`, which would have silently blocked any future specialization seeding (issue #331 Phase 4)
  - [FIX] `license.txt` file mode corrected to 644
  - [FIX] Stripped ICC color profiles from 15 PNG icons (EPV compliance)
  - [CHG] Namespace/composer/repo dropped to no-separator form (`bbguildffxiv`); DB-stored config keys (`bbguild_ffxiv_version`) preserved with the original underscore form
  - [CHG] Version tracking moved out of `phpbb_config` into `ext::BBGUILDFFXIV_VERSION`
  - [CHG] Soft-requires `avathar/bbguild >= 2.0.0-rc3`
  - [CHG] Provider return types use FQCN; removed unused `use` statements
  - [CHG] CI: unit tests now check out bbguild core alongside so plugin classes resolve core interfaces
  - [DOCS] README: fixed wrong GitHub org (bbGuild Core / Issue Tracker links pointed at `avandenberghe/bbguild` instead of `avatharbe/bbguildffxiv`), stale PHP >= 7.4.0 requirement (actual has been 8.1.0), stale race count — installer actually has 8 races (Au Ra, Hrothgar, Viera were undocumented and wrongly listed in "Known Limitations" as not-yet-included when they already were)

## 2.0.0-a1 02/03/2026
  - [NEW] Initial release as standalone phpBB extension
  - [NEW] Extracted from bbGuild core as part of the game plugin architecture
  - [NEW] Implements `game_provider_interface` — registers FFXIV with bbGuild via tagged services
  - [NEW] `ffxiv_installer` extends `abstract_game_install` with clean array-based table names
  - [NEW] `ffxiv_provider` supplies game metadata (Grand Companies, Lodestone URLs)
  - [CHG] Installer uses `$this->table()` helper instead of direct property access
  - [NOTE] Data covers A Realm Reborn — Heavensward/Stormblood/Shadowbringers/Endwalker/Dawntrail content planned
  - [NEW] Game images served from plugin directory
