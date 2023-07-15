<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecordsServices extends Model
{
    protected $table = 'records_services';

    protected $fillable = [
        'id','id_invoice_quote','name','description','price','amount','total'
    ];
}
