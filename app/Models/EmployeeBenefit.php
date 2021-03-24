<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeBenefit extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_benefits';

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
        'payroll_transaction_code_id',
        'amount',
        'taxable',
        'payroll_transaction_code',
        'payroll_transaction_description',
        'payroll_irp5_code',
        'payroll_irp5_description',
        'directive_number',
        'directive_percentage',
        'retirement_fund_include',
        'uif_include',
        'sld_include',
        'only_for_periods',
        'no_cash',];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
