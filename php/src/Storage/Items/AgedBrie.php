<?php 
declare(strict_types=1);

namespace GildedRose\Storage\Items;

abstract class AgedBrie
{
	/**
	 * @var const string NAME - defines name of the item
	 */
	public const NAME = 'Aged Brie';

	/**
	 * @var const array QUALITY_STEPS - defines quality step rules
	 */
	public const QUALITY_STEPS = [
									'Default' => 1
								 ];

	/**
	 * @var const bool AGEING - defines if items SellIn value changes
	 */
	public const AGEING = true;
}

?>