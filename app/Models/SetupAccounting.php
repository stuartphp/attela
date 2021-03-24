<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SetupAccounting extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'setup_accounting';

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
        'company_id',
'trade_classification',
'charge_delivery_cost',
'default_credit_limit',
'retained_earnings',
'profit_loss_year',
'exchange_variances_account',
'bank_charges',
'sales_account',
'sales_discount_account',
'purchase_discount_account',
'debtor_control_account',
'bad_debt_account',
'bad_debt_recovered_account',
'supplier_control_account',
'inventory_account',
'cogs_account',
'vat_control_account',
'vat_output',
'vat_input',
'vat_percentage',
'inventory_adjustments_account',
'rounding_account',
'round_to_nearest',
'depreciation_period',
'tax_number',
'is_vat_registered',
'vat_number',
'uif_number',
'sdl_number',
'paye_number',
'import_number',
'financial_year',
'financial_period',
'quote_valid_days',
'statement_message',
'tax_invoice_message',
'sales_order_message',
'quotation_message',
'receipt_message',
'credit_note_message',
'dispatch_on_invoice'
    ];
}
