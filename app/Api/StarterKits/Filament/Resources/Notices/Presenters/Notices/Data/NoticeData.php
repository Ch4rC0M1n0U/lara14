<?php

namespace App\Api\StarterKits\Filament\Resources\Notices\Presenters\Notices\Data;

use Carbon\Carbon;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\Optional as TypeScriptOptional;

/** @typescript */
class NoticeData extends Data
{
    public function __construct(
        public string $id,
		#[TypeScriptOptional]
		public ?Carbon $created_at,
		#[TypeScriptOptional]
		public ?Carbon $updated_at,
		#[TypeScriptOptional]
		public ?string $person_noticed,
		#[TypeScriptOptional]
		public ?string $typePerson,
		#[TypeScriptOptional]
		public ?Carbon $Notice_DateHour,
		#[TypeScriptOptional]
		public ?string $Canal_Notice,
    ) {
    }
}
