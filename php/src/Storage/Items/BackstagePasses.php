<?php 
declare(strict_types=1);

namespace GildedRose\Storage\Items;

abstract class BackstagePasses
{
	public const NAME = 'Backstage passes to a TAFKAL80ETC concert';
	public const QUALITY_STEPS = [
									0         => NULL,
									5         => 3,
									10        => 2,
									'Default' => 1
							  	 ];
	public const AGEING = true;
}

?>