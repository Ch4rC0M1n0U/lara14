<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Detainee extends Model
{
    use HasFactory;

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function PrivLib(): BelongsTo
    {
        return $this->belongsTo(PrivLib::class);
    }

    protected $guarded = ['id'];

    protected $fillable = [
        'firstname',
        'lastname',
        'birthdate',
        'sexe',
        'cell_id',
        'service_id',
        'priv_lib_id',
        'SSType',
        'MaxPL',
        'liberation_id',
        'trusted_contact_id',
        'created_at',
        'updated_at',
        'RplNum',
        'DevRest',
        'notice_id',
        'user_created',
        'contention_id',
        'bac',
        'salduz',
        'Prohibe',
        'incident_id',
        'EqCharge',
        'Avocate',
        'ProhiValImp',
        'medical_id',
    ];

    protected $casts = [
        'birthdate' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'isolement' => 'boolean',
        'Audition' => 'boolean',
        'PrintTrypt' => 'boolean',
        'SurvCam' => 'boolean',
        'isolement' => 'boolean',        
    ];

    protected $boolean = [
        'isolement',
        'Salduz',
        'Audition',
        'PrintTrypt',
        'SurvCam',
    ];

}
