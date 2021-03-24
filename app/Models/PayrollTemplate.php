<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollTemplate extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payroll_templates';

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
        'employee_id',
        'transaction_id',
        'amount',
        'tax_percentage',
        'tax_code',
        'tax_description',
        'transaction_description',
        'directive_percentage',
        'retirement_fund_include',
        'only_periods',
        'nocash',];
    public function employees()
    {
        return $this->belongsTo(Employee::class);
    }
}
