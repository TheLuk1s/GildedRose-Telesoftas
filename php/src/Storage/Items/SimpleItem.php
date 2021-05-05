<?php 
declare(strict_types=1);

namespace GildedRose\Storage\Items;

abstract class SimpleItem
{
	public const QUALITY_STEPS = [
									0         => -2,
									'Default' => -1
								 ];
	public const AGEING = true;
}

?>