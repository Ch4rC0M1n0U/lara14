<?php

namespace App\Api\StarterKits\Filament\Resources\Users\Presenters\Users\Data;

use Carbon\Carbon;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\Optional as TypeScriptOptional;

/** @typescript */
class UserData extends Data
{
    public function __construct(
        public string $id,
		public string $name,
		public string $email,
		#[TypeScriptOptional]
		public ?string $services,
		#[TypeScriptOptional]
		public ?string $telUser,
		#[TypeScriptOptional]
		public ?string $Matricule,
		#[TypeScriptOptional]
		public ?Carbon $created_at,
		#[TypeScriptOptional]
		public ?Carbon $updated_at,
		#[TypeScriptOptional]
		public ?string $email_verified_at,
		public string $password,
		#[TypeScriptOptional]
		public ?string $two_factor_secret,
		#[TypeScriptOptional]
		public ?string $two_factor_recovery_codes,
		#[TypeScriptOptional]
		public ?string $remember_token,
		#[TypeScriptOptional]
		public ?string $profile_photo_path,
    ) {
    }
}
