<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollTransactionCode extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payroll_transaction_codes';

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
    'transaction_code',
    'description',
    'transaction_type',
    'report_description',
    'payslip_description',
    'irp5_code',
    'irp5_description',
    'effective_from',
    'effective_to',
    'taxability',
    'taxable',
    'directive_mandatory',
    'oid_include',
    'uif_include',
    'uif_use_tax',
    'sdl_include',
    'sdl_use_tax',
    'rf_lable_include',
    'rf_lable_use_tax',
    'eti_include',
    'eti_use_tax',
'multiplier'];
}
