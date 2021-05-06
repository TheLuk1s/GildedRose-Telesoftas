<?php 
declare(strict_types=1);

namespace GildedRose\Storage\Items;

abstract class SulfurasHandOfRagnaros
{
	/**
	 * @var const string NAME - defines name of the item
	 */
	public const NAME = 'Sulfuras, Hand of Ragnaros';

	/**
	 * @var const array QUALITY_STEPS - defines quality step rules
	 */
	public const QUALITY_STEPS = ['Default' => 0];

	/**
	 * @var const bool AGEING - defines if items SellIn value changes
	 */
	public const AGEING = false;

	/**
	 * @var const int DEFAULT_QUALITY defines quality that program should make item start with
	 */
	public const DEFAULT_QUALITY = 80;
}

?>