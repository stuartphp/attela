<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyLedger extends Model
{
    //use SoftDeletes;
    public $table = 'company_ledgers';

    protected $dates = [
        'created_at',
        'updated_at',
        //'deleted_at',
    ];

    protected $fillable = [
    		'company_id',
        'ledger_number',
        'group_name',
        'normal_balance',
		'financial_category',
		'account_description',
		'is_active',

    ];
}
