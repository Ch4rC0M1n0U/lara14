<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cell extends Model
{
    use HasFactory;
    protected $fillable = [
        'CellNum',
        'CellType',
        'CellMax',
        'CellMinor',
        'CellStat'
        ];

    protected $casts = [
        'CellMinor' => 'boolean',
        'CellStat' => 'json'
    ];



    public function Cell(): HasMany
    {
        return $this->hasMany(Cell::class);
    }


}
