<?php
/**
 * bbGuild FFXIV Extension — game registry registration test
 *
 * @package   bbguildffxiv v2.0
 * @copyright 2026 avathar.be
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

/**
 * Per functional-tests.md test #2 (written for bbguildwow, which asserts
 * has_api() === true there). Unlike bbguildwow, this plugin has no
 * external API, so the adapted assertion here is has_api() === false.
 *
 * No DI container is reachable in-process from inside a
 * phpbb_functional_test_case subclass (Goutte drives the board under
 * test over real HTTP, in a separate PHP process — see
 * tests/integration-tests.md's conventions section), so the
 * 'bbguild.game_provider' tag itself can't be resolved through the real
 * container here; tests/config/services_resolve_test.php already
 * guards the service declaration statically. What this test instead
 * verifies is that ffxiv_provider, built the same way the container
 * would build it, satisfies game_registry's own contract and is found
 * under game_id 'ffxiv' with the expected API-less shape.
 *
 * @group functional
 */
class avathar_bbguildffxiv_game_registry_test extends phpbb_functional_test_case
{
	static protected function setup_extensions()
	{
		return array('avathar/bbguild', 'avathar/bbguildffxiv');
	}

	public function test_ffxiv_provider_is_registered_without_api()
	{
		$user = $this->getMockBuilder(\phpbb\user::class)
			->disableOriginalConstructor()
			->getMock();

		$installer = new \avathar\bbguildffxiv\game\ffxiv_installer(
			$this->get_db(),
			$this->get_cache_driver(),
			new \phpbb\config\config(array()),
			$user
		);

		$provider = new \avathar\bbguildffxiv\game\ffxiv_provider(
			$installer,
			$this->get_extension_manager()
		);

		$registry = new \avathar\bbguild\model\games\game_registry(array($provider));

		$this->assertTrue($registry->has('ffxiv'));

		$registered = $registry->get('ffxiv');
		$this->assertNotNull($registered);
		$this->assertSame('Final Fantasy XIV', $registered->get_game_name());
		$this->assertFalse($registered->has_api());
		$this->assertNull($registered->get_api());
	}
}
