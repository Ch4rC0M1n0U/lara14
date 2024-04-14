<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Liberation extends Model
{
    use HasFactory;

    protected $fillable = [
        'liberationDateHour',
        'dev_Before',
        'avis_Before',
        'avis_Before',
        'libe_Before',
    ];

    protected $boolean = [
        'dev_Before',
        'avis_Before',
        'avis_Before',
        'libe_Before',
    ];

    protected $casts = [
        'liberationDateHour' => 'datetime',
    ];

    public function detainees(): HasMany
    {
        return $this->hasMany(Detainee::class);
    }



}
