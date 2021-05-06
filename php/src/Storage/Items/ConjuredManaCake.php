<?php 
declare(strict_types=1);

namespace GildedRose\Storage\Items;

abstract class ConjuredManaCake
{
	/**
	 * @var const string NAME - defines name of the item
	 */
	public const NAME = 'Conjured Mana Cake';

	/**
	 * @var const array QUALITY_STEPS - defines quality step rules
	 */
	public const QUALITY_STEPS = [
									'Default' => -2
								 ];

	/**
	 * @var const bool AGEING - defines if items SellIn value changes
	 */
	public const AGEING = true;
}

?>