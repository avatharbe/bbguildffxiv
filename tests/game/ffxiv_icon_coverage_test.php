<?php
/**
 * @package bbGuild FFXIV Extension
 * @copyright (c) 2026 avathar.be
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace avathar\bbguildffxiv\tests\game;

use PHPUnit\Framework\TestCase;

/**
 * Guards icon coverage against the classes the installer actually seeds.
 *
 * The roster resolves class_images/<imagename>.png for the character rows
 * and roster_classes/<imagename>.png for the grid, so a seeded class with
 * no file behind it has no icon. The audit that produced issue #8 found 12
 * such gaps; these tests assert no *new* gap appears, with the ones still
 * outstanding listed explicitly.
 */
class ffxiv_icon_coverage_test extends TestCase
{
	/**
	 * Gaps tracked in #8 and deliberately still open:
	 * Reaper and Sage (Endwalker) plus Viper and Pictomancer (Dawntrail)
	 * are absent from XIVAPI v1, whose lighter-gold tone the shipped icons
	 * match; the v2 raw range has them in a visibly darker tone. ffxiv_unknown is
	 * an authored placeholder (avathar/bbguild#391), so it is no longer a gap.
	 */
	private const KNOWN_GAPS = array(
		'ffxiv_pictomancer',
		'ffxiv_reaper',
		'ffxiv_sage',
		'ffxiv_viper',
	);

	/**
	 * @return list<string> Every imagename seeded by the installer
	 */
	private function seeded_imagenames(): array
	{
		$src = file_get_contents(dirname(__DIR__, 2) . '/game/ffxiv_installer.php');

		preg_match_all("/'imagename'\s*=>\s*'([^']+)'/", $src, $m);

		$names = array_values(array_unique(array_filter(array_map('trim', $m[1]))));
		sort($names);

		return $names;
	}

	private function assertNoUnexpectedGaps(string $dir): void
	{
		$base    = dirname(__DIR__, 2) . '/images/' . $dir . '/';
		$missing = array();

		foreach ($this->seeded_imagenames() as $name)
		{
			if (!file_exists($base . $name . '.png'))
			{
				$missing[] = $name;
			}
		}

		$unexpected = array_values(array_diff($missing, self::KNOWN_GAPS));

		$this->assertSame(
			array(),
			$unexpected,
			$dir . ' is missing icons that are not tracked as known gaps: ' . implode(', ', $unexpected)
		);
	}

	public function test_class_images_cover_every_seeded_class(): void
	{
		$this->assertNoUnexpectedGaps('class_images');
	}

	public function test_roster_classes_cover_every_seeded_class(): void
	{
		$this->assertNoUnexpectedGaps('roster_classes');
	}

	public function test_the_installer_seeds_the_full_job_list(): void
	{
		// Guards the parser above: if the installer's array syntax changes,
		// the coverage tests must not silently pass on an empty list.
		$this->assertCount(28, $this->seeded_imagenames());
	}
}
