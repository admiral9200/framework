<?php

namespace Shopper\Framework\Repositories;

use Shopper\Framework\Models\Shop\Inventory\InventoryHistory;

class InventoryHistoryRepository extends BaseRepository
{
    /**
     * Specify Model class name.
     */
    public function model()
    {
        return InventoryHistory::class;
    }
}
