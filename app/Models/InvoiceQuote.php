<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceQuote extends Model
{
    protected $table = 'invoice_quote';

    protected $fillable = [
        'id','client','attended','taxes','discount','total','observation','terms','type','status'
    ];
}
