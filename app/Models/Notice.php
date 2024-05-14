<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notice extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'person_noticed',
        'typePerson',
        'status',
        'Notice_DateHour',
        'Canal_Notice',
    ];

    public function detainees(): HasMany
    {
        return $this->hasMany(Detainee::class);
    }

}
