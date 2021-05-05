<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Storage\ItemUpdator;
use GildedRose\Storage\ItemHandler;
use GildedRose\Storage\Items\AgedBrie;

final class GildedRose
{
    /**
     * @var Item[]
     */
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
        $this->handler = new ItemHandler();
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            $itemData = $this->handler->getItemData($item);
            
            ItemUpdator::changeQuality($item, $itemData->qualitySteps);
            ItemUpdator::changeSellIn($item, $itemData->ageing);
        }
    }

    public function fixData(): void
    {
        foreach ($this->items as $item) {
            $itemData = $this->handler->getItemData($item);

            if(!is_null($itemData->defaultQuality))
                $item->quality = $itemData->defaultQuality;
        }
    }
}
