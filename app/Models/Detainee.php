<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detainee extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'birthdate',
        'sexe',
        'service_id',
        'priv_lib_id',
        'SSType',
        'MaxPL',
        'liberation_id',
        'trusted_contact_id',
        'created_at',
        'updated_at'
    ];

}
