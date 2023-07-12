<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipmentRental extends Model
{
    protected $table = 'equipment_rental';

    protected $fillable = [
        'id','name','price','provider','phone','status'
    ];
}
