<?php

namespace App\Api\StarterKits\Filament\Resources\Liberations\Presenters\Liberations\Data;

use Carbon\Carbon;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\Optional as TypeScriptOptional;

/** @typescript */
class LiberationData extends Data
{
    public function __construct(
        public string $id,
		#[TypeScriptOptional]
		public ?Carbon $created_at,
		#[TypeScriptOptional]
		public ?Carbon $updated_at,
		#[TypeScriptOptional]
		public ?string $liberationDateHour,
		public string $dev_Before,
		public string $avis_Before,
		public string $mat_Before,
		public string $libe_Before,
    ) {
    }
}
