<?php
/**
 * @package bbGuild FFXIV Extension
 * @copyright (c) 2026 avathar.be
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

/**
 * Fixture-loading correctness for bbguildffxiv's seed data. Per
 * tests/integration-tests.md's "Notes for other plugins": this plugin has
 * no external API, so no HTTP mocks apply here — the only integration
 * value beyond the functional suite is deeper structural correctness of
 * the seeded rows themselves.
 *
 * Extends \phpbb_functional_test_case (not \phpbb_database_test_case) per
 * the integration doc's 2026-09 correction — that's what gives a real DB
 * connection and a real installed extension in this test framework.
 *
 * @group integration
 */
class avathar_bbguildffxiv_ffxiv_seed_data_test extends phpbb_functional_test_case
{
	static protected function setup_extensions()
	{
		return array('avathar/bbguild', 'avathar/bbguildffxiv');
	}

	private function get_table_prefix(): string
	{
		return self::$config['table_prefix'];
	}

	private function fetch_all(string $sql): array
	{
		$db = $this->get_db();
		$result = $db->sql_query($sql);
		$rows = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$rows[] = $row;
		}
		$db->sql_freeresult($result);

		return $rows;
	}

	public function test_every_class_has_a_valid_armor_type(): void
	{
		$valid = array('CLOTH', 'LEATHER', 'PLATE');
		$rows = $this->fetch_all('SELECT class_id, class_armor_type FROM ' . $this->get_table_prefix() . "bb_classes WHERE game_id = 'ffxiv'");

		$this->assertNotEmpty($rows);
		foreach ($rows as $row)
		{
			$this->assertContains($row['class_armor_type'], $valid, "class_id {$row['class_id']} has an invalid armor type");
		}
	}

	public function test_every_race_references_a_valid_faction(): void
	{
		$faction_rows = $this->fetch_all('SELECT faction_id FROM ' . $this->get_table_prefix() . "bb_factions WHERE game_id = 'ffxiv'");
		$valid_factions = array_map('intval', array_column($faction_rows, 'faction_id'));
		$valid_factions[] = 0;

		$race_rows = $this->fetch_all('SELECT race_id, race_faction_id FROM ' . $this->get_table_prefix() . "bb_races WHERE game_id = 'ffxiv'");

		$this->assertNotEmpty($race_rows);
		foreach ($race_rows as $row)
		{
			$this->assertContains((int) $row['race_faction_id'], $valid_factions, "race_id {$row['race_id']} references an unknown faction_id");
		}
	}

	public function test_no_duplicate_class_ids_for_this_game(): void
	{
		$rows = $this->fetch_all('SELECT class_id FROM ' . $this->get_table_prefix() . "bb_classes WHERE game_id = 'ffxiv'");
		$ids = array_column($rows, 'class_id');

		$this->assertSame(count($ids), count(array_unique($ids)), 'duplicate class_id found for game_id=ffxiv');
	}

	public function test_no_duplicate_race_ids_for_this_game(): void
	{
		$rows = $this->fetch_all('SELECT race_id FROM ' . $this->get_table_prefix() . "bb_races WHERE game_id = 'ffxiv'");
		$ids = array_column($rows, 'race_id');

		$this->assertSame(count($ids), count(array_unique($ids)), 'duplicate race_id found for game_id=ffxiv');
	}

	/**
	 * @param string $attribute 'class' or 'race'
	 * @param int[]  $expected_ids
	 */
	private function assert_language_coverage(string $attribute, array $expected_ids): void
	{
		$lang_rows = $this->fetch_all(
			'SELECT attribute_id, language FROM ' . $this->get_table_prefix() . "bb_language WHERE game_id = 'ffxiv' AND attribute = '" . $attribute . "'"
		);

		$languages = array_unique(array_column($lang_rows, 'language'));
		$this->assertNotEmpty($languages, "no bb_language rows seeded for attribute '$attribute'");

		sort($expected_ids);

		foreach ($languages as $language)
		{
			$ids_for_language = array_map('intval', array_column(
				array_filter($lang_rows, function ($row) use ($language) { return $row['language'] === $language; }),
				'attribute_id'
			));
			sort($ids_for_language);

			$this->assertSame(
				$expected_ids,
				$ids_for_language,
				"language '$language' is missing bb_language rows for some ffxiv $attribute id"
			);
		}
	}

	public function test_every_class_has_a_language_row_in_each_seeded_language(): void
	{
		$class_ids = array_map('intval', array_column(
			$this->fetch_all('SELECT class_id FROM ' . $this->get_table_prefix() . "bb_classes WHERE game_id = 'ffxiv'"),
			'class_id'
		));

		$this->assert_language_coverage('class', $class_ids);
	}

	public function test_every_race_has_a_language_row_in_each_seeded_language(): void
	{
		$race_ids = array_map('intval', array_column(
			$this->fetch_all('SELECT race_id FROM ' . $this->get_table_prefix() . "bb_races WHERE game_id = 'ffxiv'"),
			'race_id'
		));

		$this->assert_language_coverage('race', $race_ids);
	}
}
