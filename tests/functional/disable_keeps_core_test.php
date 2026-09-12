<?php
/**
 * bbGuild FFXIV Extension — plugin disable keeps core intact
 *
 * @package   bbguildffxiv v2.0
 * @copyright 2026 avathar.be
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

/**
 * Enables bbguild core + bbguildffxiv, disables bbguildffxiv, and asserts
 * core keeps working. The control here is bbguild core's own "Test Guild"
 * (id=1, game_id='custom'), seeded unconditionally by core's own
 * migration regardless of which game plugins are installed — no
 * bbguildffxiv-specific fixture is needed to prove this.
 *
 * Per functional-tests.md, this is the single most important guardrail
 * for a non-flagship plugin: disabling it must never cascade-break
 * bbguild core or an unrelated guild's page.
 *
 * @group functional
 */
class avathar_bbguildffxiv_disable_keeps_core_test extends phpbb_functional_test_case
{
	/** bbguild core's own sample guild, seeded on core install. */
	const CORE_CONTROL_GUILD_ID = 1;

	static protected function setup_extensions()
	{
		return array('avathar/bbguild', 'avathar/bbguildffxiv');
	}

	public function test_disabling_ffxiv_does_not_break_core()
	{
		// The guild view route is public (u_bbguild is granted to Guests by
		// default), so no login is needed for these two checks. Note:
		// disable_ext()/install_ext() drive their own login flow internally
		// (they assert a logged-out state before authenticating) — logging
		// in manually beforehand makes that assertion fail against an
		// already-authenticated session, so auth is deferred until just
		// before the one request that actually needs it (the ACP check).
		self::request('GET', 'app.php/guild/' . self::CORE_CONTROL_GUILD_ID, array(), false);
		self::assert_response_status_code(200);

		$this->disable_ext('avathar/bbguildffxiv');

		self::request('GET', 'app.php/guild/' . self::CORE_CONTROL_GUILD_ID, array(), false);
		self::assert_response_status_code(200);

		$this->login('admin');
		$this->admin_login();

		self::request('GET', 'adm/index.php?i=-avathar-bbguild-acp-game_module&mode=listgames&sid=' . $this->sid, array(), false);
		$status = (int) self::$client->getResponse()->getStatus();
		$this->assertLessThan(500, $status, 'bbguild core ACP game list must still load with bbguildffxiv disabled');

		$this->logout();

		$this->install_ext('avathar/bbguildffxiv');
	}
}
