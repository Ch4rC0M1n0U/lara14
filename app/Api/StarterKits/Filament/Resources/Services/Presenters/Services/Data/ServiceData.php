<?php

namespace App\Api\StarterKits\Filament\Resources\Services\Presenters\Services\Data;

use Carbon\Carbon;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\Optional as TypeScriptOptional;

/** @typescript */
class ServiceData extends Data
{
    public function __construct(
        public string $id,
		#[TypeScriptOptional]
		public ?Carbon $created_at,
		#[TypeScriptOptional]
		public ?Carbon $updated_at,
		public string $name,
		#[TypeScriptOptional]
		public ?string $exterior,
		#[TypeScriptOptional]
		public ?string $street,
		#[TypeScriptOptional]
		public ?string $street_number,
		#[TypeScriptOptional]
		public ?string $city,
		#[TypeScriptOptional]
		public ?string $zip,
		#[TypeScriptOptional]
		public ?string $phone,
		#[TypeScriptOptional]
		public ?string $email,
		#[TypeScriptOptional]
		public ?string $contact,
		#[TypeScriptOptional]
		public ?string $hierarchy,
		#[TypeScriptOptional]
		public ?string $h24,
    ) {
    }
}
