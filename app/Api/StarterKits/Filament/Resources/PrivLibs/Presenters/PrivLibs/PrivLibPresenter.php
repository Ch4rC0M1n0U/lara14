<?php

namespace App\Api\StarterKits\Filament\Resources\PrivLibs\Presenters\PrivLibs;

use App\Api\StarterKits\Filament\Resources\PrivLibs\Presenters\PrivLibs\Data\PrivLibData;
use App\Models\PrivLib as PrivLibModel;
use Illuminate\Http\Request;
use Spatie\LaravelData\Data;
use XtendPackages\RESTPresenter\Concerns\InteractsWithPresenter;
use XtendPackages\RESTPresenter\Contracts\Presentable;

class PrivLibPresenter implements Presentable
{
    use InteractsWithPresenter;

    public function __construct(
        protected Request $request,
        protected ?PrivLibModel $model,
    ) {}

    public function transform(): PrivLibData | Data
    {
        return PrivLibData::from($this->model);
    }
}
