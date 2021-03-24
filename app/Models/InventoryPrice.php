<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryPrice extends Model
{
    /**
             * The database table used by the model.
             *
             * @var string
             */
            protected $table = 'inventory_prices';

            /**
             * The database primary key value.
             *
             * @var string
             */
            protected $primaryKey = 'id';

            /**
             * Un Comment if you want to use soft deletes
             *
             * @var array
             */
            protected $fillable = [
            'inventory_item_id',
            'store_id',
            'price_include_tax',
            'cost_price',
            'retail',
            'dealer',
            'whole_sale',
            'price_list1',
            'price_list2',
            'price_list3',
            'price_list4',
            'price_list5',
            'special',
            'special_from',
            'special_to',];
            public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function items()
    {
        return $this->belongsTo(InventoryItem::class, 'inventory_item_id','id' );
    }
}
