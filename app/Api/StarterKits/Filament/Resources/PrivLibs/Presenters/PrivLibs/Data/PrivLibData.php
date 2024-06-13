<?php

namespace App\Api\StarterKits\Filament\Resources\PrivLibs\Presenters\PrivLibs\Data;

use Carbon\Carbon;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\Optional as TypeScriptOptional;

/** @typescript */
class PrivLibData extends Data
{
    public function __construct(
        public string $id,
		public string $TypeArrest,
		public string $MaxHour,
		#[TypeScriptOptional]
		public ?Carbon $created_at,
		#[TypeScriptOptional]
		public ?Carbon $updated_at,
    ) {
    }
}
