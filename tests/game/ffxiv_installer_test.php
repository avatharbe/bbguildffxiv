<?php
/**
 * @package bbGuild FFXIV Extension
 * @copyright (c) 2026 avathar.be
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace avathar\bbguildffxiv\tests\game;

use PHPUnit\Framework\TestCase;
use avathar\bbguildffxiv\game\ffxiv_installer;

/**
 * ffxiv_installer only overrides install_factions(), install_classes(),
 * and install_races() — it has no install_roles() override (the default
 * DPS/Healer/Tank roles from abstract_game_install are used unchanged)
 * and no install_specs() override (bbguildffxiv has no specializations
 * seeded yet, see the family's issue #367). Only the three overridden
 * methods are exercised here.
 */
class ffxiv_installer_test extends TestCase
{
	/** @var ffxiv_installer */
	protected $installer;

	/** @var array Captured sql_multi_insert calls: array of [table, data] */
	protected $inserted = array();

	/** @var \PHPUnit\Framework\MockObject\MockObject */
	protected $db;

	protected function setUp(): void
	{
		parent::setUp();

		$this->inserted = array();

		$this->db = $this->createMock(\phpbb\db\driver\driver_interface::class);

		// Capture sql_multi_insert calls
		$this->db->method('sql_multi_insert')
			->willReturnCallback(function ($table, $data) {
				$this->inserted[] = array('table' => $table, 'data' => $data);
			});

		// sql_query (DELETE statements) — no-op
		$this->db->method('sql_query')->willReturn(true);
		$this->db->method('sql_escape')->willReturnCallback(function ($v) { return $v; });

		$cache = $this->createMock(\phpbb\cache\driver\driver_interface::class);
		$config = new \phpbb\config\config(array());
		$user = $this->getMockBuilder(\phpbb\user::class)
			->disableOriginalConstructor()
			->getMock();

		$this->installer = new ffxiv_installer($this->db, $cache, $config, $user);

		// Set table_names and game_id via reflection (normally set by install())
		$ref = new \ReflectionClass($this->installer);

		$tn = $ref->getProperty('table_names');
		$tn->setAccessible(true);
		$tn->setValue($this->installer, array(
			'bb_factions_table'  => 'phpbb_bb_factions',
			'bb_classes_table'   => 'phpbb_bb_classes',
			'bb_races_table'     => 'phpbb_bb_races',
			'bb_language_table'  => 'phpbb_bb_language',
		));

		$gid = $ref->getProperty('game_id');
		$gid->setAccessible(true);
		$gid->setValue($this->installer, 'ffxiv');
	}

	/**
	 * Invoke a protected method on the installer.
	 */
	private function invoke_protected(string $method_name): void
	{
		$this->inserted = array();
		$method = new \ReflectionMethod(ffxiv_installer::class, $method_name);
		$method->setAccessible(true);
		$method->invoke($this->installer);
	}

	// ── Factions ───────────────────────────────────────────

	public function test_install_factions_count(): void
	{
		$this->invoke_protected('install_factions');
		$this->assertCount(1, $this->inserted);
		$this->assertCount(3, $this->inserted[0]['data']);
	}

	public function test_install_factions_ids(): void
	{
		$this->invoke_protected('install_factions');
		$factions = $this->inserted[0]['data'];
		$ids = array_column($factions, 'faction_id');
		$this->assertContains(1, $ids, 'Limsa Lominsa faction_id=1');
		$this->assertContains(2, $ids, 'Gridania faction_id=2');
		$this->assertContains(3, $ids, "Ul'dah faction_id=3");
	}

	public function test_install_factions_names(): void
	{
		$this->invoke_protected('install_factions');
		$factions = $this->inserted[0]['data'];
		$names = implode(' ', array_column($factions, 'faction_name'));
		$this->assertStringContainsString('Limsa Lominsa', $names);
		$this->assertStringContainsString('Gridania', $names);
	}

	public function test_install_factions_game_id(): void
	{
		$this->invoke_protected('install_factions');
		foreach ($this->inserted[0]['data'] as $row)
		{
			$this->assertSame('ffxiv', $row['game_id']);
		}
	}

	// ── Classes ────────────────────────────────────────────

	public function test_install_classes_count(): void
	{
		$this->invoke_protected('install_classes');
		// First insert: class rows, second insert: language rows
		$this->assertCount(2, $this->inserted);
		$this->assertCount(28, $this->inserted[0]['data']);
	}

	public function test_install_classes_valid_armor_types(): void
	{
		$this->invoke_protected('install_classes');
		// FFXIV has no MAIL armor type, unlike bbguildwow.
		$valid = array('CLOTH', 'LEATHER', 'PLATE');
		foreach ($this->inserted[0]['data'] as $row)
		{
			$this->assertContains($row['class_armor_type'], $valid, "class_id {$row['class_id']} has valid armor type");
		}
	}

	public function test_install_classes_unique_ids(): void
	{
		$this->invoke_protected('install_classes');
		$ids = array_column($this->inserted[0]['data'], 'class_id');
		$this->assertSame(count($ids), count(array_unique($ids)), 'class_id values must be unique per game');
	}

	public function test_install_classes_game_id(): void
	{
		$this->invoke_protected('install_classes');
		foreach ($this->inserted[0]['data'] as $row)
		{
			$this->assertSame('ffxiv', $row['game_id']);
		}
	}

	public function test_install_classes_language_coverage(): void
	{
		$this->invoke_protected('install_classes');
		$lang_rows = $this->inserted[1]['data'];
		$languages = array_unique(array_column($lang_rows, 'language'));
		sort($languages);
		// This installer is en/fr/de only — unlike bbguildwow it does not
		// seed an 'it' translation.
		$this->assertSame(array('de', 'en', 'fr'), $languages);
	}

	public function test_install_classes_language_entries_per_lang(): void
	{
		$this->invoke_protected('install_classes');
		$lang_rows = $this->inserted[1]['data'];
		$per_lang = array_count_values(array_column($lang_rows, 'language'));
		// 28 classes x 3 languages = 84 total
		foreach ($per_lang as $lang => $count)
		{
			$this->assertSame(28, $count, "$lang has 28 class name entries");
		}
	}

	// ── Races ──────────────────────────────────────────────

	public function test_install_races_count(): void
	{
		$this->invoke_protected('install_races');
		// First insert: race rows, second insert: language rows
		$this->assertCount(2, $this->inserted);
		$this->assertCount(9, $this->inserted[0]['data']);
	}

	public function test_install_races_valid_factions(): void
	{
		$this->invoke_protected('install_races');
		// Grand Companies are faction_id 1-3 (no faction_id 0 "neutral" race
		// in this installer, unlike bbguildwow's Pandaren).
		foreach ($this->inserted[0]['data'] as $row)
		{
			$this->assertContains($row['race_faction_id'], array(1, 2, 3), "race_id {$row['race_id']} has valid faction");
		}
	}

	public function test_install_races_unique_ids(): void
	{
		$this->invoke_protected('install_races');
		$ids = array_column($this->inserted[0]['data'], 'race_id');
		$this->assertSame(count($ids), count(array_unique($ids)), 'race_id values must be unique per game');
	}

	public function test_install_races_game_id(): void
	{
		$this->invoke_protected('install_races');
		foreach ($this->inserted[0]['data'] as $row)
		{
			$this->assertSame('ffxiv', $row['game_id']);
		}
	}

	public function test_install_races_language_coverage(): void
	{
		$this->invoke_protected('install_races');
		$lang_rows = $this->inserted[1]['data'];
		$languages = array_unique(array_column($lang_rows, 'language'));
		sort($languages);
		$this->assertSame(array('de', 'en', 'fr'), $languages);
	}

	public function test_install_races_language_entries_per_lang(): void
	{
		$this->invoke_protected('install_races');
		$lang_rows = $this->inserted[1]['data'];
		$per_lang = array_count_values(array_column($lang_rows, 'language'));
		// 9 races x 3 languages = 27 total
		foreach ($per_lang as $lang => $count)
		{
			$this->assertSame(9, $count, "$lang has 9 race name entries");
		}
	}
}
