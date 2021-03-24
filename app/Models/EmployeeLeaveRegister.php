<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeLeaveRegister extends Model
{
    /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'employee_leave_registers';

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
        'leave_type',
        'from_date',
        'to_date',
        'total_days',
        'reason',];
        public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
