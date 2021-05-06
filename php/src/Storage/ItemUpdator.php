<?php
declare(strict_types=1);

namespace GildedRose\Storage;

use GildedRose\Item;
use GildedRose\Storage\ItemHandler;

class ItemUpdator
{
    /**
     * Changes quality for the item
     *
     * @param Item &$item - reference to item
     * @param array $qualitySteps - defines quality step rules for current item
     * @param array $boundaries - defines minimum and maximum quality for item (DEFAULT [0 ; 50])
     */ 
    public static function changeQuality(Item &$item, array $qualitySteps, array $boundaries = ['Min' => 0, 'Max' => 50]): void
    {	
        # Defines local default step and unsets from main array
    	$_defaultStep = $qualitySteps['Default'];
    	unset($qualitySteps['Default']);

        # Checks if not empty ant sorts from lowest to highest key, keys are maximum value rule for item quality
    	if(!empty($qualitySteps)){
    		ksort($qualitySteps);

    		foreach($qualitySteps as $key => $qualityStep) {
    			if($item->sell_in <= $key) {
    				$_defaultStep = $qualityStep;
    				break;
    			}
    		}
    	}

        # Checks if quality boundaries are exceeded. If yes - return
        if(!self::checkBoundaries($_defaultStep, $item->quality, $boundaries))
            return;
        
    	if(!is_null($_defaultStep))
    		$item->quality = $item->quality + $_defaultStep;
    	else
            self::setQuality($item, 0);
    }

    /**
     * Changes SellIn value for the item
     *
     * @param Item &$item - reference to item
     * @param bool $ageing - defines if ageing applicable for item
     */ 
    public static function changeSellIn(Item &$item, bool $ageing): void
    {
    	if($ageing) {
    		$item->sell_in--;
    	}
    }

    /**
     * Changes SellIn value for the item
     *
     * @param Item &$item - reference to item
     * @param int $quality - defines quality we need to set for item
     */ 
    public static function setQuality(Item &$item, int $quality): void
    {
        $item->quality = $quality;
    }

    /**
     * Checks if quality boundaries are not exceeded to change it
     *
     * @param int $qualityStep - current item quality step
     * @param int $quality - current item quality
     * @param array $boundaries - boundries our quality should not exceed
     * 
     * @return bool if boundries are not exceeded
     */ 
    private static function checkBoundaries(int $qualityStep, int $quality, array $boundaries): bool
    {   

        if(($qualityStep < $boundaries['Min'] && $quality == $boundaries['Min']) || ($qualityStep < $boundaries['Max'] && $quality == $boundaries['Max']))
            return false;

        return true;
    }
}