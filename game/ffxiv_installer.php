<?php
/**
 * FFXIV Installer
 *
 * Installs Final Fantasy XIV factions, classes/jobs, races, and roles.
 * Extends the abstract_game_install from bbGuild core.
 *
 * @package   bbguildffxiv v2.0
 * @copyright 2018 avathar.be
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 * @author    Brytor (Legion of Altana)
 * @author    Sajaki
 */

namespace avathar\bbguildffxiv\game;

use avathar\bbguild\model\games\abstract_game_install;

/**
 * Class ffxiv_installer
 *
 * @package avathar\bbguildffxiv\game
 */
class ffxiv_installer extends abstract_game_install
{
	/**
	 * Installs FFXIV factions (Grand Companies)
	 */
	protected function install_factions()
	{

		$this->db->sql_query('DELETE FROM ' . $this->table('bb_factions_table') . " WHERE game_id = '" . $this->db->sql_escape($this->game_id) . "'");
		$sql_ary = array();
		$sql_ary[] = array('game_id' => $this->game_id, 'faction_id' => 1, 'faction_name' => "Limsa Lominsa: The Maelstrom");
		$sql_ary[] = array('game_id' => $this->game_id, 'faction_id' => 2, 'faction_name' => "Gridania: The Order of the Twin Adder");
		$sql_ary[] = array('game_id' => $this->game_id, 'faction_id' => 3, 'faction_name' => "Ul\xe2\x80\x99dah: The Immortal Flames");
		$this->db->sql_multi_insert($this->table('bb_factions_table'), $sql_ary);
	}

	/**
	 * Installs FFXIV classes and jobs with translations (en, fr, de)
	 */
	protected function install_classes()
	{

		$this->db->sql_query('DELETE FROM ' . $this->table('bb_classes_table') . " WHERE game_id = '" . $this->db->sql_escape($this->game_id) . "'");
		$sql_ary = array();
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 0,  'class_armor_type' => 'CLOTH',   'class_min_level' => 1, 'class_max_level' => 100, 'imagename' => 'ffxiv_unknown');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 1,  'class_armor_type' => 'LEATHER', 'class_min_level' => 1, 'class_max_level' => 100, 'imagename' => 'ffxiv_archer');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 2,  'class_armor_type' => 'LEATHER', 'class_min_level' => 1, 'class_max_level' => 100, 'imagename' => 'ffxiv_bard');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 3,  'class_armor_type' => 'PLATE',   'class_min_level' => 1, 'class_max_level' => 100, 'imagename' => 'ffxiv_gladiator');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 4,  'class_armor_type' => 'PLATE',   'class_min_level' => 1, 'class_max_level' => 100, 'imagename' => 'ffxiv_paladin');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 5,  'class_armor_type' => 'PLATE',   'class_min_level' => 1, 'class_max_level' => 100, 'imagename' => 'ffxiv_lancer');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 6,  'class_armor_type' => 'PLATE',   'class_min_level' => 1, 'class_max_level' => 100, 'imagename' => 'ffxiv_dragoon');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 7,  'class_armor_type' => 'PLATE',   'class_min_level' => 1, 'class_max_level' => 100, 'imagename' => 'ffxiv_marauder');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 8,  'class_armor_type' => 'PLATE',   'class_min_level' => 1, 'class_max_level' => 100, 'imagename' => 'ffxiv_warrior');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 9,  'class_armor_type' => 'LEATHER', 'class_min_level' => 1, 'class_max_level' => 100, 'imagename' => 'ffxiv_pugilist');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 10, 'class_armor_type' => 'LEATHER', 'class_min_level' => 1, 'class_max_level' => 100, 'imagename' => 'ffxiv_conjurer');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 11, 'class_armor_type' => 'CLOTH',   'class_min_level' => 1, 'class_max_level' => 100, 'imagename' => 'ffxiv_white_mage');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 12, 'class_armor_type' => 'CLOTH',   'class_min_level' => 1, 'class_max_level' => 100, 'imagename' => 'ffxiv_thaumaturge');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 13, 'class_armor_type' => 'CLOTH',   'class_min_level' => 1, 'class_max_level' => 100, 'imagename' => 'ffxiv_black_mage');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 14, 'class_armor_type' => 'CLOTH',   'class_min_level' => 1, 'class_max_level' => 100, 'imagename' => 'ffxiv_arcanist');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 15, 'class_armor_type' => 'CLOTH',   'class_min_level' => 1, 'class_max_level' => 100, 'imagename' => 'ffxiv_summoner');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 16, 'class_armor_type' => 'CLOTH',   'class_min_level' => 1, 'class_max_level' => 100, 'imagename' => 'ffxiv_scholar');
		// Heavensward
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 17, 'class_armor_type' => 'PLATE',   'class_min_level' => 1, 'class_max_level' => 100, 'imagename' => 'ffxiv_dark_knight');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 18, 'class_armor_type' => 'CLOTH',   'class_min_level' => 1, 'class_max_level' => 100, 'imagename' => 'ffxiv_astrologian');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 19, 'class_armor_type' => 'LEATHER', 'class_min_level' => 1, 'class_max_level' => 100, 'imagename' => 'ffxiv_machinist');
		// Stormblood
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 20, 'class_armor_type' => 'CLOTH',   'class_min_level' => 1, 'class_max_level' => 100, 'imagename' => 'ffxiv_red_mage');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 21, 'class_armor_type' => 'LEATHER', 'class_min_level' => 1, 'class_max_level' => 100, 'imagename' => 'ffxiv_samurai');
		// Shadowbringers
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 22, 'class_armor_type' => 'PLATE',   'class_min_level' => 1, 'class_max_level' => 100, 'imagename' => 'ffxiv_gunbreaker');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 23, 'class_armor_type' => 'LEATHER', 'class_min_level' => 1, 'class_max_level' => 100, 'imagename' => 'ffxiv_dancer');
		// Endwalker
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 24, 'class_armor_type' => 'CLOTH',   'class_min_level' => 1, 'class_max_level' => 100, 'imagename' => 'ffxiv_sage');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 25, 'class_armor_type' => 'LEATHER', 'class_min_level' => 1, 'class_max_level' => 100, 'imagename' => 'ffxiv_reaper');
		// Dawntrail
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 26, 'class_armor_type' => 'LEATHER', 'class_min_level' => 1, 'class_max_level' => 100, 'imagename' => 'ffxiv_viper');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 27, 'class_armor_type' => 'CLOTH',   'class_min_level' => 1, 'class_max_level' => 100, 'imagename' => 'ffxiv_pictomancer');
		$this->db->sql_multi_insert($this->table('bb_classes_table'), $sql_ary);
		unset($sql_ary);

		// class/job names in multiple languages
		$this->db->sql_query('DELETE FROM ' . $this->table('bb_language_table') . " WHERE game_id = '" . $this->db->sql_escape($this->game_id) . "' AND attribute='class' ");

		$sql_ary = array();
		// en
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 0,  'language' => 'en', 'attribute' => 'class', 'name' => 'Unknown',      'name_short' => 'Unknown');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 1,  'language' => 'en', 'attribute' => 'class', 'name' => 'Archer',       'name_short' => 'Archer');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 2,  'language' => 'en', 'attribute' => 'class', 'name' => 'Bard',         'name_short' => 'Bard');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 3,  'language' => 'en', 'attribute' => 'class', 'name' => 'Gladiator',    'name_short' => 'Gladiator');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 4,  'language' => 'en', 'attribute' => 'class', 'name' => 'Paladin',      'name_short' => 'Paladin');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 5,  'language' => 'en', 'attribute' => 'class', 'name' => 'Lancer',       'name_short' => 'Dragoon');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 6,  'language' => 'en', 'attribute' => 'class', 'name' => 'Marauder',     'name_short' => 'Marauder');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 7,  'language' => 'en', 'attribute' => 'class', 'name' => 'Warrior',      'name_short' => 'Warrior');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 8,  'language' => 'en', 'attribute' => 'class', 'name' => 'Pugilist',     'name_short' => 'Pugilist');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 9,  'language' => 'en', 'attribute' => 'class', 'name' => 'Monk',         'name_short' => 'Monk');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 10, 'language' => 'en', 'attribute' => 'class', 'name' => 'Conjurer',     'name_short' => 'Conjurer');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 11, 'language' => 'en', 'attribute' => 'class', 'name' => 'White Mage',   'name_short' => 'White Mage');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 12, 'language' => 'en', 'attribute' => 'class', 'name' => 'Thaumaturge',  'name_short' => 'Thaumaturge');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 13, 'language' => 'en', 'attribute' => 'class', 'name' => 'Black Mage',   'name_short' => 'Black Mage');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 14, 'language' => 'en', 'attribute' => 'class', 'name' => 'Arcanist',     'name_short' => 'Arcanist');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 15, 'language' => 'en', 'attribute' => 'class', 'name' => 'Summoner',     'name_short' => 'Summoner');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 16, 'language' => 'en', 'attribute' => 'class', 'name' => 'Scholar',      'name_short' => 'Scholar');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 17, 'language' => 'en', 'attribute' => 'class', 'name' => 'Dark Knight',  'name_short' => 'Dark Knight');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 18, 'language' => 'en', 'attribute' => 'class', 'name' => 'Astrologian',  'name_short' => 'Astrologian');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 19, 'language' => 'en', 'attribute' => 'class', 'name' => 'Machinist',    'name_short' => 'Machinist');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 20, 'language' => 'en', 'attribute' => 'class', 'name' => 'Red Mage',     'name_short' => 'Red Mage');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 21, 'language' => 'en', 'attribute' => 'class', 'name' => 'Samurai',      'name_short' => 'Samurai');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 22, 'language' => 'en', 'attribute' => 'class', 'name' => 'Gunbreaker',   'name_short' => 'Gunbreaker');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 23, 'language' => 'en', 'attribute' => 'class', 'name' => 'Dancer',       'name_short' => 'Dancer');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 24, 'language' => 'en', 'attribute' => 'class', 'name' => 'Sage',         'name_short' => 'Sage');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 25, 'language' => 'en', 'attribute' => 'class', 'name' => 'Reaper',       'name_short' => 'Reaper');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 26, 'language' => 'en', 'attribute' => 'class', 'name' => 'Viper',        'name_short' => 'Viper');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 27, 'language' => 'en', 'attribute' => 'class', 'name' => 'Pictomancer',  'name_short' => 'Pictomancer');

		// fr
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 0,  'language' => 'fr', 'attribute' => 'class', 'name' => 'Unknown',      'name_short' => 'Unknown');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 1,  'language' => 'fr', 'attribute' => 'class', 'name' => 'Archer',       'name_short' => 'Archer');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 2,  'language' => 'fr', 'attribute' => 'class', 'name' => 'Bard',         'name_short' => 'Bard');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 3,  'language' => 'fr', 'attribute' => 'class', 'name' => 'Gladiator',    'name_short' => 'Gladiator');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 4,  'language' => 'fr', 'attribute' => 'class', 'name' => 'Paladin',      'name_short' => 'Paladin');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 5,  'language' => 'fr', 'attribute' => 'class', 'name' => 'Lancer',       'name_short' => 'Dragoon');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 6,  'language' => 'fr', 'attribute' => 'class', 'name' => 'Marauder',     'name_short' => 'Marauder');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 7,  'language' => 'fr', 'attribute' => 'class', 'name' => 'Warrior',      'name_short' => 'Warrior');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 8,  'language' => 'fr', 'attribute' => 'class', 'name' => 'Pugilist',     'name_short' => 'Pugilist');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 9,  'language' => 'fr', 'attribute' => 'class', 'name' => 'Monk',         'name_short' => 'Monk');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 10, 'language' => 'fr', 'attribute' => 'class', 'name' => 'Conjurer',     'name_short' => 'Conjurer');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 11, 'language' => 'fr', 'attribute' => 'class', 'name' => 'White Mage',   'name_short' => 'White Mage');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 12, 'language' => 'fr', 'attribute' => 'class', 'name' => 'Thaumaturge',  'name_short' => 'Thaumaturge');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 13, 'language' => 'fr', 'attribute' => 'class', 'name' => 'Black Mage',   'name_short' => 'Black Mage');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 14, 'language' => 'fr', 'attribute' => 'class', 'name' => 'Arcanist',     'name_short' => 'Arcanist');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 15, 'language' => 'fr', 'attribute' => 'class', 'name' => 'Summoner',     'name_short' => 'Summoner');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 16, 'language' => 'fr', 'attribute' => 'class', 'name' => 'Scholar',      'name_short' => 'Scholar');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 17, 'language' => 'fr', 'attribute' => 'class', 'name' => 'Dark Knight',  'name_short' => 'Dark Knight');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 18, 'language' => 'fr', 'attribute' => 'class', 'name' => 'Astrologian',  'name_short' => 'Astrologian');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 19, 'language' => 'fr', 'attribute' => 'class', 'name' => 'Machinist',    'name_short' => 'Machinist');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 20, 'language' => 'fr', 'attribute' => 'class', 'name' => 'Red Mage',     'name_short' => 'Red Mage');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 21, 'language' => 'fr', 'attribute' => 'class', 'name' => 'Samurai',      'name_short' => 'Samurai');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 22, 'language' => 'fr', 'attribute' => 'class', 'name' => 'Gunbreaker',   'name_short' => 'Gunbreaker');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 23, 'language' => 'fr', 'attribute' => 'class', 'name' => 'Dancer',       'name_short' => 'Dancer');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 24, 'language' => 'fr', 'attribute' => 'class', 'name' => 'Sage',         'name_short' => 'Sage');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 25, 'language' => 'fr', 'attribute' => 'class', 'name' => 'Reaper',       'name_short' => 'Reaper');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 26, 'language' => 'fr', 'attribute' => 'class', 'name' => 'Viper',        'name_short' => 'Viper');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 27, 'language' => 'fr', 'attribute' => 'class', 'name' => 'Pictomancer',  'name_short' => 'Pictomancer');

		// de
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 0,  'language' => 'de', 'attribute' => 'class', 'name' => 'Unknown',      'name_short' => 'Unknown');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 1,  'language' => 'de', 'attribute' => 'class', 'name' => 'Archer',       'name_short' => 'Archer');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 2,  'language' => 'de', 'attribute' => 'class', 'name' => 'Bard',         'name_short' => 'Bard');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 3,  'language' => 'de', 'attribute' => 'class', 'name' => 'Gladiator',    'name_short' => 'Gladiator');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 4,  'language' => 'de', 'attribute' => 'class', 'name' => 'Paladin',      'name_short' => 'Paladin');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 5,  'language' => 'de', 'attribute' => 'class', 'name' => 'Lancer',       'name_short' => 'Dragoon');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 6,  'language' => 'de', 'attribute' => 'class', 'name' => 'Marauder',     'name_short' => 'Marauder');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 7,  'language' => 'de', 'attribute' => 'class', 'name' => 'Warrior',      'name_short' => 'Warrior');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 8,  'language' => 'de', 'attribute' => 'class', 'name' => 'Pugilist',     'name_short' => 'Pugilist');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 9,  'language' => 'de', 'attribute' => 'class', 'name' => 'Monk',         'name_short' => 'Monk');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 10, 'language' => 'de', 'attribute' => 'class', 'name' => 'Conjurer',     'name_short' => 'Conjurer');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 11, 'language' => 'de', 'attribute' => 'class', 'name' => 'White Mage',   'name_short' => 'White Mage');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 12, 'language' => 'de', 'attribute' => 'class', 'name' => 'Thaumaturge',  'name_short' => 'Thaumaturge');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 13, 'language' => 'de', 'attribute' => 'class', 'name' => 'Black Mage',   'name_short' => 'Black Mage');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 14, 'language' => 'de', 'attribute' => 'class', 'name' => 'Arcanist',     'name_short' => 'Arcanist');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 15, 'language' => 'de', 'attribute' => 'class', 'name' => 'Summoner',     'name_short' => 'Summoner');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 16, 'language' => 'de', 'attribute' => 'class', 'name' => 'Scholar',      'name_short' => 'Scholar');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 17, 'language' => 'de', 'attribute' => 'class', 'name' => 'Dark Knight',  'name_short' => 'Dark Knight');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 18, 'language' => 'de', 'attribute' => 'class', 'name' => 'Astrologian',  'name_short' => 'Astrologian');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 19, 'language' => 'de', 'attribute' => 'class', 'name' => 'Machinist',    'name_short' => 'Machinist');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 20, 'language' => 'de', 'attribute' => 'class', 'name' => 'Red Mage',     'name_short' => 'Red Mage');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 21, 'language' => 'de', 'attribute' => 'class', 'name' => 'Samurai',      'name_short' => 'Samurai');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 22, 'language' => 'de', 'attribute' => 'class', 'name' => 'Gunbreaker',   'name_short' => 'Gunbreaker');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 23, 'language' => 'de', 'attribute' => 'class', 'name' => 'Dancer',       'name_short' => 'Dancer');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 24, 'language' => 'de', 'attribute' => 'class', 'name' => 'Sage',         'name_short' => 'Sage');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 25, 'language' => 'de', 'attribute' => 'class', 'name' => 'Reaper',       'name_short' => 'Reaper');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 26, 'language' => 'de', 'attribute' => 'class', 'name' => 'Viper',        'name_short' => 'Viper');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 27, 'language' => 'de', 'attribute' => 'class', 'name' => 'Pictomancer',  'name_short' => 'Pictomancer');

		$this->db->sql_multi_insert($this->table('bb_language_table'), $sql_ary);
	}

	/**
	 * Installs FFXIV races with translations (en, fr, de)
	 */
	protected function install_races()
	{

		$this->db->sql_query('DELETE FROM ' . $this->table('bb_races_table') . " WHERE game_id = '" . $this->db->sql_escape($this->game_id) . "'");
		$sql_ary = array();
		$sql_ary[] = array('game_id' => $this->game_id, 'race_id' => 1, 'race_faction_id' => 3, 'image_female' => '',                      'image_male' => '');
		$sql_ary[] = array('game_id' => $this->game_id, 'race_id' => 2, 'race_faction_id' => 1, 'image_female' => 'ffxiv_roegadyn_female', 'image_male' => 'ffxiv_roegadyn_male');
		$sql_ary[] = array('game_id' => $this->game_id, 'race_id' => 3, 'race_faction_id' => 3, 'image_female' => 'ffxiv_hyur_female',     'image_male' => 'ffxiv_hyur_male');
		$sql_ary[] = array('game_id' => $this->game_id, 'race_id' => 4, 'race_faction_id' => 2, 'image_female' => 'ffxiv_elezen_female',   'image_male' => 'ffxiv_elezen_male');
		$sql_ary[] = array('game_id' => $this->game_id, 'race_id' => 5, 'race_faction_id' => 2, 'image_female' => 'ffxiv_lalafell_female', 'image_male' => 'ffxiv_lalafell_male');
		$sql_ary[] = array('game_id' => $this->game_id, 'race_id' => 6, 'race_faction_id' => 3, 'image_female' => 'ffxiv_miqote_female',   'image_male' => 'ffxiv_miqote_male');
		// Au Ra
		$sql_ary[] = array('game_id' => $this->game_id, 'race_id' => 7, 'race_faction_id' => 3, 'image_female' => 'ffxiv_aura_female',     'image_male' => 'ffxiv_aura_male');
		// Hrothgar
		$sql_ary[] = array('game_id' => $this->game_id, 'race_id' => 8, 'race_faction_id' => 3, 'image_female' => 'ffxiv_hrothgar_female', 'image_male' => 'ffxiv_hrothgar_male');
		// Viera
		$sql_ary[] = array('game_id' => $this->game_id, 'race_id' => 9, 'race_faction_id' => 3, 'image_female' => 'ffxiv_viera_female',    'image_male' => 'ffxiv_viera_male');
		$this->db->sql_multi_insert($this->table('bb_races_table'), $sql_ary);
		unset($sql_ary);

		// race names
		$this->db->sql_query('DELETE FROM ' . $this->table('bb_language_table') . " WHERE game_id = '" . $this->db->sql_escape($this->game_id) . "' AND attribute = 'race' ");

		$miqote = "Miqo\xe2\x80\x99te";

		$sql_ary = array();
		// en
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 1, 'language' => 'en', 'attribute' => 'race', 'name' => 'Unknown',   'name_short' => 'Unknown');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 2, 'language' => 'en', 'attribute' => 'race', 'name' => 'Roegadyn',  'name_short' => 'Roegadyn');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 3, 'language' => 'en', 'attribute' => 'race', 'name' => 'Hyur',      'name_short' => 'Hyur');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 4, 'language' => 'en', 'attribute' => 'race', 'name' => 'Elezen',    'name_short' => 'Elezen');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 5, 'language' => 'en', 'attribute' => 'race', 'name' => 'Lalafell',  'name_short' => 'Lalafell');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 6, 'language' => 'en', 'attribute' => 'race', 'name' => $miqote,     'name_short' => $miqote);
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 7, 'language' => 'en', 'attribute' => 'race', 'name' => 'Au Ra',      'name_short' => 'Au Ra');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 8, 'language' => 'en', 'attribute' => 'race', 'name' => 'Hrothgar',   'name_short' => 'Hrothgar');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 9, 'language' => 'en', 'attribute' => 'race', 'name' => 'Viera',      'name_short' => 'Viera');

		// fr
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 1, 'language' => 'fr', 'attribute' => 'race', 'name' => 'Unknown',   'name_short' => 'Unknown');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 2, 'language' => 'fr', 'attribute' => 'race', 'name' => 'Roegadyn',  'name_short' => 'Roegadyn');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 3, 'language' => 'fr', 'attribute' => 'race', 'name' => 'Hyur',      'name_short' => 'Hyur');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 4, 'language' => 'fr', 'attribute' => 'race', 'name' => 'Elezen',    'name_short' => 'Elezen');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 5, 'language' => 'fr', 'attribute' => 'race', 'name' => 'Lalafell',  'name_short' => 'Lalafell');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 6, 'language' => 'fr', 'attribute' => 'race', 'name' => $miqote,     'name_short' => $miqote);
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 7, 'language' => 'fr', 'attribute' => 'race', 'name' => 'Ao Ra',       'name_short' => 'Ao Ra');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 8, 'language' => 'fr', 'attribute' => 'race', 'name' => 'Hrothgar',    'name_short' => 'Hrothgar');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 9, 'language' => 'fr', 'attribute' => 'race', 'name' => 'Viéra',       'name_short' => 'Viéra');

		// de
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 1, 'language' => 'de', 'attribute' => 'race', 'name' => 'Unknown',   'name_short' => 'Unknown');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 2, 'language' => 'de', 'attribute' => 'race', 'name' => 'Roegadyn',  'name_short' => 'Roegadyn');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 3, 'language' => 'de', 'attribute' => 'race', 'name' => 'Hyur',      'name_short' => 'Hyur');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 4, 'language' => 'de', 'attribute' => 'race', 'name' => 'Elezen',    'name_short' => 'Elezen');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 5, 'language' => 'de', 'attribute' => 'race', 'name' => 'Lalafell',  'name_short' => 'Lalafell');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 6, 'language' => 'de', 'attribute' => 'race', 'name' => $miqote,     'name_short' => $miqote);
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 7, 'language' => 'de', 'attribute' => 'race', 'name' => 'Au Ra',       'name_short' => 'Au Ra');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 8, 'language' => 'de', 'attribute' => 'race', 'name' => 'Hrothgar',    'name_short' => 'Hrothgar');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 9, 'language' => 'de', 'attribute' => 'race', 'name' => 'Viera',       'name_short' => 'Viera');

		$this->db->sql_multi_insert($this->table('bb_language_table'), $sql_ary);
	}

	/**
	 * Installs FFXIV specializations (issue #331 opt-in / issue #7).
	 *
	 * FFXIV has no specialization layer beyond the Job itself — see the
	 * docblock on ffxiv_provider::spec_catalog() for why this deliberately
	 * seeds nothing. Kept as a real override (rather than relying on the
	 * abstract_game_install no-op default) so the empty-catalog decision
	 * is visible and documented here, and so this plugin follows the same
	 * shape as bbguildgw2's install_specs() should a spec layer ever be
	 * added later.
	 *
	 * Skipped if bb_specializations_table isn't wired in (older core
	 * installs that haven't run migration v200b4 yet).
	 */
	protected function install_specs(): void
	{
		if (!isset($this->table_names['bb_specializations_table']))
		{
			return;
		}

		$rows = [];
		foreach (ffxiv_provider::spec_catalog() as $class_id => $specs)
		{
			foreach ($specs as $spec)
			{
				$rows[] = [
					'game_id'    => $this->game_id,
					'class_id'   => (int) $class_id,
					'role_id'    => (int) $spec['role_id'],
					'spec_name'  => (string) $spec['spec_name'],
					'spec_icon'  => (string) $spec['spec_icon'],
					'spec_order' => (int) $spec['spec_order'],
				];
			}
		}
		if (!$rows)
		{
			return;
		}
		$this->db->sql_multi_insert($this->table('bb_specializations_table'), $rows);
	}
}
