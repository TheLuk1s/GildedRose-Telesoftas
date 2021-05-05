<?php
declare(strict_types=1);

namespace GildedRose\Storage;

use GildedRose\Item;

use GildedRose\Storage\Items\AgedBrie;
use GildedRose\Storage\Items\BackstagePasses;
use GildedRose\Storage\Items\ConjuredManaCake;
use GildedRose\Storage\Items\SimpleItem;
use GildedRose\Storage\Items\SulfurasHandOfRagnaros;

class ItemHandler
{
    public function __construct(array $qualitySteps = [], bool $ageing = true, ?int $defaultQuality = NULL) {
    	$this->qualitySteps = $qualitySteps;
    	$this->ageing = $ageing;
    	$this->defaultQuality = $defaultQuality;
    }

    public function getItemData(Item $item): self
    {
		switch ($item->name) {
            case AgedBrie::NAME:
            	return new self(AgedBrie::QUALITY_STEPS, AgedBrie::AGEING);
            case BackstagePasses::NAME:
                return new self(BackstagePasses::QUALITY_STEPS, BackstagePasses::AGEING);
            case ConjuredManaCake::NAME:
                return new self(ConjuredManaCake::QUALITY_STEPS, ConjuredManaCake::AGEING);
            case SulfurasHandOfRagnaros::NAME:
                return new self(SulfurasHandOfRagnaros::QUALITY_STEPS, SulfurasHandOfRagnaros::AGEING, SulfurasHandOfRagnaros::DEFAULT_QUALITY);
            default:
                return new self(SimpleItem::QUALITY_STEPS, SimpleItem::AGEING);
        }
    }
}