<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrustedContact extends Model
{
    use HasFactory;

    public function detainees(): HasMany
    {
        return $this->hasMany(Detainee::class);
    }

    protected $fillable = [
        'firstname',
        'lastname',
        'phone',
        'email',
        'street',
        'street_number',
        'zip',
        'city',
        'relationType',
        'contact_DateHour',
        'TypeOfContact',
        'motivation_Refusal',
        'created_at',
        'updated_at',
    ];

    protected $guarded = ['id'];

    protected $casts = [
        'contact_DateHour' => 'datetime',
        'motivation_Refusal' => 'array',
    ];

    
    
}
