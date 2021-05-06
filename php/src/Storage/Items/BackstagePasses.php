<?php 
declare(strict_types=1);

namespace GildedRose\Storage\Items;

abstract class BackstagePasses
{
	/**
	 * @var const string NAME - defines name of the item
	 */
	public const NAME = 'Backstage passes to a TAFKAL80ETC concert';

	/**
	 * @var const array QUALITY_STEPS - defines quality step rules
	 */
	public const QUALITY_STEPS = [
									0         => NULL,
									5         => 3,
									10        => 2,
									'Default' => 1
							  	 ];

 	/**
	 * @var const bool AGEING - defines if items SellIn value changes
	 */
	public const AGEING = true;
}

?>