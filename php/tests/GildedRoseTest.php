<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Storage;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{	
	#new Item(string $name, int $sell_in, int $quality)

    #1 End of each day should lower both values for every item
    public function testLowerValues(): void
    {
    	$items = [new Item('Any', 1, 1)];
    	$gildedRose = new GildedRose($items);
    	$gildedRose->updateQuality();

    	# Checking if those two values lowers by 1
    	$this->assertSame(0, $items[0]->sell_in);
    	$this->assertSame(0, $items[0]->quality);
    }

    #2 Once the sell by date has passed, Quality degrades twice as fast
    public function testOutdatedQualityDegration(): void
    {
    	$items = [new Item('Any', 0, 2)];
    	$gildedRose = new GildedRose($items);
    	$gildedRose->updateQuality();

    	# Checking if quality degraded by 2
    	$this->assertSame(0, $items[0]->quality);
    }

    #3 Quality of item is never negative
    public function testQualityNegativity(): void
    {
    	$items = [new Item('Any', 0, 0)];
    	$gildedRose = new GildedRose($items);
    	$gildedRose->updateQuality();

    	# Checking if quality is still 0 after leaving it 0 for a day
    	$this->assertSame(0, $items[0]->quality);
    }

    #4 "Aged Brie" actually increases in Quality the older it gets
    public function testBrieQualityIncrease(): void
    {
    	$items = [new Item('Aged Brie', 1, 0)];
    	$gildedRose = new GildedRose($items);
    	$gildedRose->updateQuality();

    	# Checking if quality increased by 1 when initial is 0
    	$this->assertSame(1, $items[0]->quality);
    }

    #5 The Quality of an item is never more than 50
    public function testMaxItemQuality(): void
    {
    	$items = [new Item('Aged Brie', 1, 50)];
    	$gildedRose = new GildedRose($items);
    	$gildedRose->updateQuality();

    	#Checking if quality of the item is 50 after initial 50
    	$this->assertSame(50, $items[0]->quality);
    }

    #6 "Sulfuras" is a legendary item and as such its Quality is 80 and it never alters
    public function testMaxLegendaryItemQuality(): void
    {
    	$items = [new Item('Sulfuras, Hand of Ragnaros', 1, 80)];
    	$gildedRose = new GildedRose($items);
    	$gildedRose->updateQuality();

    	#Checking if quality of the legendary item is 80 after initial 80
    	$this->assertSame(80, $items[0]->quality);
    }

    #7 "Sulfuras", being a legendary item, never has to be sold or decreases in Quality
    public function testSulfurasUnitsStability(): void
    {
    	$items = [new Item('Sulfuras, Hand of Ragnaros', 100, 80)];
    	$gildedRose = new GildedRose($items);
    	$gildedRose->updateQuality();

    	#Checking if quality and sell_in stays the same for legendary items
    	$this->assertSame(80, $items[0]->quality);
    	$this->assertSame(100, $items[0]->sell_in);
    }

    #8.1 "Backstage passes", like aged brie, increases in Quality as its SellIn value approaches
    public function testBackstagePassQualityIncrease(): void
    {
    	$items = [new Item('Backstage passes to a TAFKAL80ETC concert', 15, 0)];
    	$gildedRose = new GildedRose($items);
    	$gildedRose->updateQuality();

    	#Checking if backstage passes increases by 1
    	$this->assertSame(1, $items[0]->quality);
    }

    #8.2 "Backstage passes" Quality increases by 2 when there are 10 days or less
    public function testBackstagePassQualityIncreaseByTwo(): void
    {
    	$items = [new Item('Backstage passes to a TAFKAL80ETC concert', 10, 0)];
    	$gildedRose = new GildedRose($items);
    	$gildedRose->updateQuality();

    	#Checking if backstage passes increases by 2 when 10 days left
    	$this->assertSame(2, $items[0]->quality);
    }

    #8.3 "Backstage passes" Quality increases by 3 when there are 5 days or less
    public function testBackstagePassQualityIncreaseByThrre(): void
    {
    	$items = [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 0)];
    	$gildedRose = new GildedRose($items);
    	$gildedRose->updateQuality();

    	#Checking if backstage passes increases by 3 when 5 days left
    	$this->assertSame(3, $items[0]->quality);
    }

    #8.4 "Backstage passes" Quality drops to 0 after the concert
    public function testBackstagePassQualityDrop(): void
    {
    	$items = [new Item('Backstage passes to a TAFKAL80ETC concert', 0, 100)];
    	$gildedRose = new GildedRose($items);
    	$gildedRose->updateQuality();

    	#Checking if backstage passes quality drops to 0 when concert is over
    	$this->assertSame(0, $items[0]->quality);
    }

    #9 "Conjured" items degrade in Quality twice as fast as normal items
    # LEAVING FOR UPDATE
    // public function testCojuredItemDegration(): void
    // {
    // 	$items = [new Item('Conjured Mana Cake', 1, 100)];
    // 	$gildedRose = new GildedRose($items);
    // 	$gildedRose->updateQuality();
    // 	$this->assertSame(98, $items[0]->quality);
    // }
}
