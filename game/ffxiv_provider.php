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

/**
 * Class ffxiv_provider
 *
 * @package avathar\bbguildffxiv\game
 */
class ffxiv_provider implements game_provider_interface
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
	public function get_installer(): game_install_interface
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
	public function get_api(): ?game_api_interface
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
}
