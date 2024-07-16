<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reloj extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable=[
        'name',
        'star_time',
        'end_time',
        'number_minutes_1',
        'number_minutes_2',
        'number_minutes_3',
        'state',
        'employee_id',
    ];

}
