<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Storage\ItemUpdator;
use GildedRose\Storage\ItemHandler;
use GildedRose\Storage\Items\AgedBrie;

final class GildedRose
{
    /**
     * Item array
     *
     * @var array $items[]
     */
    private $items;

    /**
     * ItemHandler object to get item data
     *
     * @var ItemHandler $handler
     */
    private ItemHandler $handler;


    /**
     * Class constructor
     *
     * @param array $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
        $this->handler = new ItemHandler();
    }

    /**
     * Passes one day
     *
     */
    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            $itemData = $this->handler->getItemData($item);
            
            ItemUpdator::changeQuality($item, $itemData->qualitySteps);
            ItemUpdator::changeSellIn($item, $itemData->ageing);
        }
    }

    /**
     * Fixes incorrect data
     *
     */
    public function fixData(): void
    {
        foreach ($this->items as $item) {
            $itemData = $this->handler->getItemData($item);

            if(!is_null($itemData->defaultQuality))
                ItemUpdator::setQuality($item, $itemData->defaultQuality);
        }
    }
}
