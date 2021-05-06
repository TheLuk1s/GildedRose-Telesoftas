<?php 
declare(strict_types=1);

namespace GildedRose\Storage\Items;

abstract class SimpleItem
{
	/**
	 * @var const array QUALITY_STEPS - defines quality step rules
	 */
	public const QUALITY_STEPS = [
									0         => -2,
									'Default' => -1
								 ];

	/**
	 * @var const bool AGEING - defines if items SellIn value changes
	 */
	public const AGEING = true;
}

?>