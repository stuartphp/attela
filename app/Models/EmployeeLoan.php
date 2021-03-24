<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeLoan extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_loans';

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
    protected $fillable = ['employee_id',
    'reference_number',
    'issue_date',
    'start_date',
    'end_date',
    'start_period',
    'end_period',
    'total_amount_due',
    'transaction_code',
    'balance',
    'interest_on_amount',
    'interest_amount',
    'interest_transaction_code',
    'interest_perc',
    'paid_up',
    'settlement_date',
    'settlement_reason',];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

}
