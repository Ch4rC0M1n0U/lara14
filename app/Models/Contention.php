<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contention extends Model
{
    use HasFactory;
    // Réalise moi la table protected lié à la database Contention
    protected $guarded = ['id'];

    // Réalise moi la table protected lié à la database Contention
    protected $fillable = [
        'autorisedBy',
        'autorised_DateHour',
        'contention_DateHour',
        'motivation',
        'detainee_id',
        'created_at',
        'updated_at',
    ];

    public function detainees(): HasMany
    {
        return $this->hasMany(Detainee::class);
    }

}
