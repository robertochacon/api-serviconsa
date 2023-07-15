<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeExpense extends Model
{
    protected $table = 'employee_expense';

    protected $fillable = [
        'id','id_employee','description','total','type'
    ];
}
