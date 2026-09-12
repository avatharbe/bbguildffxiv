<?php
/**
 * bbGuild FFXIV Extension — extension enable test
 *
 * @package   bbguildffxiv v2.0
 * @copyright 2026 avathar.be
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

/**
 * Enables bbguild core, then bbguildffxiv on top. Asserts the migration
 * seeded a 'ffxiv' row in bb_games, seeded this plugin's classes/jobs in
 * bb_classes for game_id='ffxiv', and that the version constant baked
 * into ext.php matches composer.json.
 *
 * Unlike functional-tests.md's test #1 (written for bbguildwow), this
 * plugin has no ACP module of its own — there is nothing ACP-side to
 * assert here.
 *
 * @group functional
 */
class avathar_bbguildffxiv_extension_enable_test extends phpbb_functional_test_case
{
	static protected function setup_extensions()
	{
		return array('avathar/bbguild', 'avathar/bbguildffxiv');
	}

	private function get_table_prefix(): string
	{
		return self::$config['table_prefix'];
	}

	private function count_rows(string $table, string $where): int
	{
		$db = $this->get_db();
		$sql = 'SELECT COUNT(*) AS cnt FROM ' . $table . ' WHERE ' . $where;
		$result = $db->sql_query($sql);
		$count = (int) $db->sql_fetchfield('cnt');
		$db->sql_freeresult($result);

		return $count;
	}

	public function test_ffxiv_game_row_seeded()
	{
		$count = $this->count_rows($this->get_table_prefix() . 'bb_games', "game_id = 'ffxiv'");
		$this->assertSame(1, $count, 'expected exactly one ffxiv row in bb_games after enabling bbguildffxiv');
	}

	public function test_ffxiv_classes_seeded()
	{
		$count = $this->count_rows($this->get_table_prefix() . 'bb_classes', "game_id = 'ffxiv'");
		$this->assertSame(28, $count, 'expected 28 ffxiv classes/jobs seeded in bb_classes');
	}

	public function test_version_constant_matches_composer_json()
	{
		$composer = json_decode(file_get_contents(__DIR__ . '/../../composer.json'), true);

		$this->assertSame(
			$composer['version'],
			\avathar\bbguildffxiv\ext::BBGUILDFFXIV_VERSION,
			'ext::BBGUILDFFXIV_VERSION must match composer.json "version"'
		);
	}
}
