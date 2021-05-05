<?php
declare(strict_types=1);

namespace GildedRose\Storage;

use GildedRose\Item;
use GildedRose\Storage\ItemHandler;

class ItemUpdator
{
    public static function changeQuality(Item &$item, array $qualitySteps, array $boundaries = ['Min' => 0, 'Max' => 50]): void
    {	
    	$_defaultStep = $qualitySteps['Default'];
    	unset($qualitySteps['Default']);

    	if(!empty($qualitySteps)){
    		ksort($qualitySteps);

    		foreach($qualitySteps as $key => $qualityStep) {
    			if($item->sell_in <= $key) {
    				$_defaultStep = $qualityStep;
    				break;
    			}
    		}
    	}

    	if(($_defaultStep < $boundaries['Min'] && $item->quality == $boundaries['Min']) || ($_defaultStep < $boundaries['Max'] && $item->quality == $boundaries['Max']))
    		return;

    	if(!is_null($_defaultStep))
    		$item->quality = $item->quality + $_defaultStep;
    	else
    		$item->quality = 0;
    }

    public static function changeSellIn(Item &$item, bool $ageing): void
    {
    	if($ageing) {
    		$item->sell_in--;
    	}
    }
}