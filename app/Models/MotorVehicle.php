<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotorVehicle extends Model
{
    use HasFactory;
    protected $table = 'motor_vehicle';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'reg_no',
        'year_of_man',
        'vehicle_type',
        'tonnage',
    ];
}
