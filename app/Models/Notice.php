<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use LaravelArchivable\Archivable;

class Notice extends Model
{
    use HasFactory;
    use Archivable;

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
