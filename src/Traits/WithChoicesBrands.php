<?php

namespace Shopper\Framework\Traits;

trait WithChoicesBrands
{
    public $selectedBrand = [];

    public function updatedSelectedBrand($choice)
    {
        if (count($choice) > 0 && $choice['value'] !== '0') {
            $this->brand_id = (int) $choice['value'];
        } else {
            $this->brand_id = null;
        }
    }
}
