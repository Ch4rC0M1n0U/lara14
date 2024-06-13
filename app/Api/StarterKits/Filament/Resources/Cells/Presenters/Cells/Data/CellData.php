<?php

namespace App\Api\StarterKits\Filament\Resources\Cells\Presenters\Cells\Data;

use Carbon\Carbon;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\Optional as TypeScriptOptional;

/** @typescript */
class CellData extends Data
{
    public function __construct(
        public string $id,
		#[TypeScriptOptional]
		public ?Carbon $created_at,
		#[TypeScriptOptional]
		public ?Carbon $updated_at,
		public string $CellNum,
		#[TypeScriptOptional]
		public ?string $CellType,
		#[TypeScriptOptional]
		public ?int $CellMax,
		public string $CellMinor,
		#[TypeScriptOptional]
		public ?string $CellStat,
		#[TypeScriptOptional]
		public ?int $CellRest,
    ) {
    }
}
