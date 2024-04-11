<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PrivLib extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'TypeArrest',
        'MaxHour',
    ];

    public function detainees(): HasMany
    {
        return $this->hasMany(Detainee::class);
    }

}
