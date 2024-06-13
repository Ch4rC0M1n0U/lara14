<?php

namespace App\Api\StarterKits\Filament\Resources\Detainees\Presenters\Detainees\Data;

use Carbon\Carbon;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\Optional as TypeScriptOptional;

/** @typescript */
class DetaineeData extends Data
{
    public function __construct(
        public string $id,
		#[TypeScriptOptional]
		public ?string $created_at,
		#[TypeScriptOptional]
		public ?string $updated_at,
		public string $firstname,
		public string $lastname,
		public string $birthdate,
		public string $sexe,
		public string $cell_id,
		public string $service_id,
		public string $priv_lib_id,
		#[TypeScriptOptional]
		public ?string $SSType,
		public string $liberation_id,
		public string $trusted_contact_id,
		public string $isolement,
		public string $RplNum,
		#[TypeScriptOptional]
		public ?string $Salduz,
		#[TypeScriptOptional]
		public ?array $DevRest,
		#[TypeScriptOptional]
		public ?string $notice_id,
		#[TypeScriptOptional]
		public ?string $user_created,
		#[TypeScriptOptional]
		public ?string $Audition,
		#[TypeScriptOptional]
		public ?string $PrintTrypt,
		#[TypeScriptOptional]
		public ?string $contention_id,
		#[TypeScriptOptional]
		public ?int $bac,
		#[TypeScriptOptional]
		public ?string $Prohibe,
		#[TypeScriptOptional]
		public ?string $incident_id,
		#[TypeScriptOptional]
		public ?string $EqCharge,
		#[TypeScriptOptional]
		public ?string $Avocate,
		public string $ProhiValImp,
		#[TypeScriptOptional]
		public ?string $SurvCam,
		#[TypeScriptOptional]
		public ?string $medical_id,
    ) {
    }
}
