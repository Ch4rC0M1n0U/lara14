<?php

namespace App\Api\StarterKits\Filament\Resources\Contentions\Presenters\Contentions\Data;

use Carbon\Carbon;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\Optional as TypeScriptOptional;

/** @typescript */
class ContentionData extends Data
{
    public function __construct(
        public string $id,
		#[TypeScriptOptional]
		public ?Carbon $created_at,
		#[TypeScriptOptional]
		public ?Carbon $updated_at,
		public string $autorisedBy,
		public Carbon $autorised_DateHour,
		public Carbon $contention_DateHour,
		public string $motivation,
    ) {
    }
}
