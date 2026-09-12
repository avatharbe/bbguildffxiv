<?php
/**
 * FFXIV Game Provider
 *
 * Registers Final Fantasy XIV as a game plugin with bbGuild core.
 *
 * @package   bbguildffxiv v2.0
 * @copyright 2018 avathar.be
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

namespace avathar\bbguildffxiv\game;

use avathar\bbguild\model\games\game_provider_interface;
use avathar\bbguild\model\games\specialization_provider_interface;

/**
 * Class ffxiv_provider
 *
 * @package avathar\bbguildffxiv\game
 */
class ffxiv_provider implements game_provider_interface, specialization_provider_interface
{
	/** @var ffxiv_installer */
	private $installer;

	/** @var \phpbb\extension\manager */
	private $ext_manager;

	/**
	 * @param ffxiv_installer            $installer
	 * @param \phpbb\extension\manager   $ext_manager
	 */
	public function __construct(ffxiv_installer $installer, \phpbb\extension\manager $ext_manager)
	{
		$this->installer = $installer;
		$this->ext_manager = $ext_manager;
	}

	/**
	 * @inheritdoc
	 */
	public function get_game_id(): string
	{
		return 'ffxiv';
	}

	/**
	 * @inheritdoc
	 */
	public function get_game_name(): string
	{
		return 'Final Fantasy XIV';
	}

	/**
	 * @inheritdoc
	 */
	public function get_installer(): \avathar\bbguild\model\games\game_install_interface
	{
		return $this->installer;
	}

	/**
	 * @inheritdoc
	 */
	public function get_boss_base_url(): string
	{
		return 'http://na.finalfantasyxiv.com/lodestone/playguide/db/npc/enemy/%s/';
	}

	/**
	 * @inheritdoc
	 */
	public function get_zone_base_url(): string
	{
		return 'http://na.finalfantasyxiv.com/lodestone/playguide/db/npc/?category2=enemy&area=%s';
	}

	/**
	 * @inheritdoc
	 */
	public function get_images_path(): string
	{
		return $this->ext_manager->get_extension_path('avathar/bbguildffxiv', true) . 'images/';
	}

	/**
	 * @inheritdoc
	 */
	public function has_api(): bool
	{
		return false;
	}

	/**
	 * @inheritdoc
	 */
	public function get_api(): ?\avathar\bbguild\model\games\game_api_interface
	{
		return null;
	}

	/**
	 * @inheritdoc
	 */
	public function get_regions(): array
	{
		return array(
			'us' => 'NA',
			'eu' => 'EU',
		);
	}

	/**
	 * @inheritdoc
	 */
	public function get_api_locales(): array
	{
		return array();
	}

	/**
	 * @inheritdoc
	 */
	public function get_armor_types(): array
	{
		return array(
			'CLOTH'   => 'Cloth',
			'LEATHER' => 'Leather',
			'PLATE'   => 'Plate',
		);
	}

	/**
	 * Specialization catalog (issue #331 opt-in / this plugin's issue #7),
	 * keyed by class_id — deliberately empty.
	 *
	 * FFXIV's real "class evolves into something more specific" layer is
	 * the Class → Job system (Lancer → Dragoon, Gladiator → Paladin,
	 * Conjurer → White Mage, Arcanist → Summoner/Scholar, etc.), and
	 * game/ffxiv_installer.php's install_classes() already seeds every one
	 * of those as its own terminal class_id (0-27: base Disciples of War/
	 * Magic alongside every unlocked Job through Dawntrail's Viper and
	 * Pictomancer). A Job is not itself further subdivided — FFXIV has no
	 * per-job talent trees, loadout specs, or named build branches the way
	 * WoW specs or GW2 Elite Specializations work (confirmed against the
	 * live game: each Job is intentionally a single, complete kit, not a
	 * choice between sub-builds). So unlike bbguildgw2 (whose classes stop
	 * at the base profession and whose Elite Specializations are the
	 * missing layer this system was built for), there is no further
	 * granularity left to seed for FFXIV — every class_id here already IS
	 * the most specific, terminal build. Returning [] is the honest
	 * answer, not a placeholder: it deliberately avoids inventing a spec
	 * layer that doesn't exist in the real game.
	 *
	 * @return array<int, list<array{spec_name:string,role_id:int,spec_icon:string,spec_order:int}>>
	 */
	public static function spec_catalog(): array
	{
		return array();
	}

	/**
	 * @inheritdoc
	 */
	public function get_spec_label(): string
	{
		return 'Job';
	}

	/**
	 * Interface implementation: delegates to the static catalog.
	 *
	 * @return array<int, list<array{spec_name:string,role_id:int,spec_icon:string,spec_order:int}>>
	 */
	public function get_specializations(): array
	{
		return self::spec_catalog();
	}
}
