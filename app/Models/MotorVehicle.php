<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class MotorVehicle extends Model
{
    use HasFactory, HasApiTokens;
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
