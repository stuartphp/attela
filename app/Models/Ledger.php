<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    //use SoftDeletes;
    public $table = 'ledgers';

    protected $dates = [
        'created_at',
        'updated_at',
        //'deleted_at',
    ];

    protected $fillable = [
        'ledger_number',
        'group_name',
        'normal_balance',
		'financial_category',
		'account_description',
		'is_active',

    ];
}
