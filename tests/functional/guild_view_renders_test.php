<?php
/**
 * bbGuild FFXIV Extension — guild view rendering test
 *
 * @package   bbguildffxiv v2.0
 * @copyright 2026 avathar.be
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

/**
 * Inserts a guild fixture with game_id='ffxiv' and one player using a
 * valid FFXIV class/race, then GETs the guild's portal page as an
 * authenticated user. Asserts the roster module actually rendered the
 * player row, with the class image resolving under this plugin's own
 * images path (ext/avathar/bbguildffxiv/images/) — proving guild_context
 * wiring, the roster portal module, and ffxiv_provider::get_images_path()
 * all work together end to end.
 *
 * @group functional
 */
class avathar_bbguildffxiv_guild_view_renders_test extends phpbb_functional_test_case
{
	/**
	 * Fixed id, distinct from bbguild core's own sample guild
	 * (id=1, game_id='custom', seeded unconditionally by core's install).
	 * Must stay within bb_guild.id's USINT range (signed SMALLINT on
	 * Postgres, max 32767) — 92101 overflowed it and failed CI.
	 */
	const GUILD_ID = 20243;

	static protected function setup_extensions()
	{
		return array('avathar/bbguild', 'avathar/bbguildffxiv');
	}

	private function get_table_prefix(): string
	{
		return self::$config['table_prefix'];
	}

	private function insert_fixture(): void
	{
		$db = $this->get_db();

		$db->sql_query('DELETE FROM ' . $this->get_table_prefix() . 'bb_guild WHERE id = ' . self::GUILD_ID);
		$db->sql_query('DELETE FROM ' . $this->get_table_prefix() . 'bb_players WHERE player_guild_id = ' . self::GUILD_ID);

		$db->sql_multi_insert($this->get_table_prefix() . 'bb_guild', array(array(
			'id'             => self::GUILD_ID,
			'name'           => 'Ffxiv Test Guild',
			'realm'          => 'Test Realm',
			'region'         => 'us',
			'roster'         => 1,
			'players'        => 1,
			'emblemurl'      => '',
			'game_id'        => 'ffxiv',
			'game_edition'   => 'retail',
			'min_armory'     => 0,
			'rec_status'     => 1,
			'guilddefault'   => 0,
			'armory_enabled' => 0,
			'armoryresult'   => '',
			'recruitforum'   => 0,
			'faction'        => 0,
		)));

		$db->sql_multi_insert($this->get_table_prefix() . 'bb_players', array(array(
			'game_id'         => 'ffxiv',
			'player_name'     => 'Ffxivtestplayer',
			'player_region'   => 'us',
			'player_realm'    => 'Test Realm',
			'player_title'    => '',
			'player_level'    => 90,
			'player_race_id'  => 3, // Hyur
			'player_class_id' => 3, // Gladiator (PLATE)
			'player_rank_id'  => 0,
			'player_role'     => 'DPS',
			'player_comment'  => '',
			'player_guild_id' => self::GUILD_ID,
			'player_status'   => 1,
		)));

		// A fresh guild has no portal layout at all — bbguild core only
		// auto-seeds a roster module for its own sample guild_id=1 (see
		// migrations/v200b3::insert_sample_data()). Without this row the
		// roster module never renders and the player row above is invisible.
		$db->sql_query('DELETE FROM ' . $this->get_table_prefix() . 'bb_portal_modules WHERE guild_id = ' . self::GUILD_ID);
		$db->sql_multi_insert($this->get_table_prefix() . 'bb_portal_modules', array(array(
			'guild_id'            => self::GUILD_ID,
			'module_classname'    => '\avathar\bbguild\portal\modules\roster',
			'module_column'       => 2,
			'module_order'        => 1,
			'module_name'         => 'BBGUILD_PORTAL_ROSTER',
			'module_image_src'    => '',
			'module_icon'         => '',
			'module_icon_size'    => 16,
			'module_image_width'  => 16,
			'module_image_height' => 16,
			'module_group_ids'    => '',
			'module_status'       => 1,
		)));
	}

	public function test_guild_view_renders_ffxiv_roster_row()
	{
		$this->insert_fixture();
		$this->login('admin');

		self::request('GET', 'app.php/guild/' . self::GUILD_ID, array(), false);
		self::assert_response_status_code(200);

		$content = self::$client->getResponse()->getContent();
		$this->assertStringContainsString('Ffxivtestplayer', $content);
		$this->assertStringContainsString('ext/avathar/bbguildffxiv/images/', $content);

		$this->logout();
	}
}
