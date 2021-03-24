<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollTransaction extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payroll_transactions';

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
    protected $fillable = ['employee_id','transaction_period','tax_description','transaction_description','payslip','posted','company_id',];
    public function employees()
    {
        return $this->belongsTo(Employee::class);
    }
}
