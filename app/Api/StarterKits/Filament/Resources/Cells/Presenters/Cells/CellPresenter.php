<?php

namespace App\Api\StarterKits\Filament\Resources\Cells\Presenters\Cells;

use App\Api\StarterKits\Filament\Resources\Cells\Presenters\Cells\Data\CellData;
use App\Models\Cell as CellModel;
use Illuminate\Http\Request;
use Spatie\LaravelData\Data;
use XtendPackages\RESTPresenter\Concerns\InteractsWithPresenter;
use XtendPackages\RESTPresenter\Contracts\Presentable;

class CellPresenter implements Presentable
{
    use InteractsWithPresenter;

    public function __construct(
        protected Request $request,
        protected ?CellModel $model,
    ) {}

    public function transform(): CellData | Data
    {
        return CellData::from($this->model);
    }
}
