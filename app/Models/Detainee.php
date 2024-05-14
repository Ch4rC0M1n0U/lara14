<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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

    public function Liberation(): BelongsTo
    {
        return $this->belongsTo(Liberation::class);
    }

    public function TrustedContact(): BelongsTo
    {
        return $this->belongsTo(TrustedContact::class);
    }

    public function Notice(): BelongsTo
    {
        return $this->belongsTo(Notice::class);
    }

    public function Contention(): BelongsTo
    {
        return $this->belongsTo(Contention::class);
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
        'medical_id',
    ];

    protected $casts = [
        'birthdate' => 'date',
        'DevRest' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'isolement' => 'boolean',
        'Audition' => 'boolean',
        'PrintTrypt' => 'boolean',
        'SurvCam' => 'boolean',
        'isolement' => 'boolean',
        'Avocate' => 'boolean',
        'ProhiValImp' => 'boolean',
    ];

    protected $boolean = [
        'isolement',
        'Salduz',
        'Audition',
        'PrintTrypt',
        'SurvCam',
        'Avocate',
        'ProhiValImp',
    ];

}
