<?php
/**
 * bbGuild FFXIV Extension — migration idempotency smoke test
 *
 * @package   bbguildffxiv v2.0
 * @copyright 2026 avathar.be
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

/**
 * Disables bbguildffxiv (data preserved) and re-enables it, then asserts
 * seeded rows were not duplicated. Disable does not revert schema/data,
 * so re-enabling re-runs the migration's effectively_installed() check
 * against data that's already there — this is the only way to exercise
 * that path without a second fresh install. Catches migrations that
 * mistakenly re-seed or re-create on a second run.
 *
 * Unlike bbguildwow, this plugin has no bb_specializations rows yet
 * (spec data is a separate, unimplemented ticket), so bb_games,
 * bb_classes, bb_races, and bb_language row counts for game_id='ffxiv'
 * are checked instead.
 *
 * @group smoke
 */
class avathar_bbguildffxiv_smoke_migration_idempotency_test extends phpbb_functional_test_case
{
	static protected function setup_extensions()
	{
		return array('avathar/bbguild', 'avathar/bbguildffxiv');
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

	public function test_reenable_does_not_duplicate_seeded_data()
	{
		$before_games = $this->count_rows($this->get_table_prefix() . 'bb_games', "game_id = 'ffxiv'");
		$before_classes = $this->count_rows($this->get_table_prefix() . 'bb_classes', "game_id = 'ffxiv'");
		$before_races = $this->count_rows($this->get_table_prefix() . 'bb_races', "game_id = 'ffxiv'");
		$before_language = $this->count_rows($this->get_table_prefix() . 'bb_language', "game_id = 'ffxiv'");
		$before_migrations = $this->count_rows($this->get_table_prefix() . 'migrations', "migration_name LIKE '%bbguildffxiv%'");

		$this->disable_ext('avathar/bbguildffxiv');
		$this->install_ext('avathar/bbguildffxiv');

		$after_games = $this->count_rows($this->get_table_prefix() . 'bb_games', "game_id = 'ffxiv'");
		$after_classes = $this->count_rows($this->get_table_prefix() . 'bb_classes', "game_id = 'ffxiv'");
		$after_races = $this->count_rows($this->get_table_prefix() . 'bb_races', "game_id = 'ffxiv'");
		$after_language = $this->count_rows($this->get_table_prefix() . 'bb_language', "game_id = 'ffxiv'");
		$after_migrations = $this->count_rows($this->get_table_prefix() . 'migrations', "migration_name LIKE '%bbguildffxiv%'");

		$this->assertSame(1, $before_games, 'expected exactly one ffxiv row in bb_games before re-enable');
		$this->assertSame($before_games, $after_games, 'bb_games ffxiv row was duplicated on re-enable');
		$this->assertSame($before_classes, $after_classes, 'bb_classes ffxiv rows were duplicated on re-enable');
		$this->assertSame($before_races, $after_races, 'bb_races ffxiv rows were duplicated on re-enable');
		$this->assertSame($before_language, $after_language, 'bb_language ffxiv rows were duplicated on re-enable');
		$this->assertSame($before_migrations, $after_migrations, 'bbguildffxiv migration rows changed on re-enable');
	}

	private function get_table_prefix(): string
	{
		return self::$config['table_prefix'];
	}
}
