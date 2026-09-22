# bbGuild - Final Fantasy XIV

Final Fantasy XIV doesn't even call them guilds — they're Free Companies — and Savage/Ultimate raiding culture runs on tightly coordinated static groups where knowing who plays what matters. bbguildffxiv covers all 27 classes and jobs — from the A Realm Reborn base classes through every expansion job up to Dawntrail (Viper and Pictomancer) — and all 8 races (Au Ra, Hrothgar, and Viera), plus the three Grand Companies and boss/zone links to the official Lodestone. It's built to give your static and your FC roster a proper home on the forum, not just a pinned post nobody updates.

## Features

- **FFXIV Classes & Jobs** - 27 classes and jobs spanning A Realm Reborn through Dawntrail (the ARR base classes and their jobs, plus every job-only class: Dark Knight, Astrologian, Machinist, Red Mage, Samurai, Gunbreaker, Dancer, Sage, Reaper, Viper, Pictomancer)
- **FFXIV Races** - 8 playable races (Hyur, Elezen, Lalafell, Miqo'te, Roegadyn, Au Ra, Hrothgar, Viera)
- **Grand Companies** - The Maelstrom, The Order of the Twin Adder, The Immortal Flames
- **Localization** - Class and race names in English, French, and German
- **Lodestone Links** - Boss and zone database URLs linked to the official FFXIV Lodestone

## Requirements

- phpBB >= 3.3.0
- PHP >= 8.1.0
- **bbGuild core** (`avathar/bbguild`) must be installed and enabled

## Installation

1. Ensure bbGuild core (`avathar/bbguild`) is installed and enabled.
2. Copy the `bbguildffxiv` folder to `/ext/avathar/bbguildffxiv/`.
3. Navigate in the ACP to `Customise -> Manage extensions`.
4. Look for `bbGuild - Final Fantasy XIV` under Disabled Extensions and click `Enable`.
5. Go to ACP > bbGuild > Games and install the **Final Fantasy XIV** game.

## Uninstall

1. Navigate in the ACP to `Customise -> Extension Management -> Extensions`.
2. Find `bbGuild - Final Fantasy XIV` under Enabled Extensions and click `Disable`.
3. To permanently uninstall, click `Delete Data` and then delete the `/ext/avathar/bbguildffxiv` folder.

**Note:** Disabling the extension does not delete existing guild or player data. Your roster and player records remain intact in bbGuild core.

## Game Data

### Classes & Jobs

| ID | Class/Job | Armor | Base Class |
|----|-----------|-------|------------|
| 1 | Archer | Leather | - |
| 2 | Bard | Leather | Archer |
| 3 | Gladiator | Plate | - |
| 4 | Paladin | Plate | Gladiator |
| 5 | Lancer | Plate | - |
| 6 | Dragoon | Plate | Lancer |
| 7 | Marauder | Plate | - |
| 8 | Warrior | Plate | Marauder |
| 9 | Pugilist | Leather | - |
| 10 | Conjurer | Leather | - |
| 11 | White Mage | Cloth | Conjurer |
| 12 | Thaumaturge | Cloth | - |
| 13 | Black Mage | Cloth | Thaumaturge |
| 14 | Arcanist | Cloth | - |
| 15 | Summoner | Cloth | Arcanist |
| 16 | Scholar | Cloth | Arcanist |
| 17 | Dark Knight | Plate | - |
| 18 | Astrologian | Cloth | - |
| 19 | Machinist | Leather | - |
| 20 | Red Mage | Cloth | - |
| 21 | Samurai | Leather | - |
| 22 | Gunbreaker | Plate | - |
| 23 | Dancer | Leather | - |
| 24 | Sage | Cloth | - |
| 25 | Reaper | Leather | - |
| 26 | Viper | Leather | - |
| 27 | Pictomancer | Cloth | - |

### Races

| ID | Race | Faction |
|----|------|---------|
| 2 | Roegadyn | Maelstrom |
| 3 | Hyur | Neutral |
| 4 | Elezen | Twin Adder |
| 5 | Lalafell | Twin Adder |
| 6 | Miqo'te | Neutral |
| 7 | Au Ra | Neutral |
| 8 | Hrothgar | Neutral |
| 9 | Viera | Neutral |

## License

[GNU General Public License v2](http://opensource.org/licenses/gpl-2.0.php)

## Links

- [bbGuild Core](https://github.com/avatharbe/bbguild)
- [FFXIV Lodestone](https://na.finalfantasyxiv.com/lodestone/)
- [Issue Tracker](https://github.com/avatharbe/bbguildffxiv/issues)
