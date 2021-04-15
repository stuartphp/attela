<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'inventory_items';

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
        protected $fillable = ['company_id',
        'item_code',
        'description',
        'dictation',
        'keywords',
        'tags',
        'category_id',
        'barcode',
        'isbn_number',
        'unit',
        'commodity_code',
        'nett_mass_gram',
        'is_service',
        'allow_tax',
        'purchase_tax_type',
        'sales_tax_type',
        'is_fixed_description',
        'sales_commission_item',
        'is_active',];
        public function category()
        {
            return $this->belongsTo(InventoryCategory::class, 'category_id', 'id');
        }

        public function units()
        {
            return $this->hasOne(InventoryUnit::class, 'id', 'unit');
        }

        public function purchase_tax()
        {
            return $this->hasOne(TaxType::class, 'number', 'purchase_tax_type');
        }
        public function sales_tax()
        {
            return $this->hasOne(TaxType::class, 'number', 'sales_tax_type');
        }

        public function prices()
        {
            return $this->hasMany(InventoryPrice::class, 'inventory_item_id', 'id');
        }

        public function image()
        {
            return $this->hasMany(InventoryImage::class, 'inventory_item_id', 'id');
        }
}
