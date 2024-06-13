<?php

namespace App\Api\StarterKits\Filament\Resources\Services\Presenters\Services;

use App\Api\StarterKits\Filament\Resources\Services\Presenters\Services\Data\ServiceData;
use App\Models\Service as ServiceModel;
use Illuminate\Http\Request;
use Spatie\LaravelData\Data;
use XtendPackages\RESTPresenter\Concerns\InteractsWithPresenter;
use XtendPackages\RESTPresenter\Contracts\Presentable;

class ServicePresenter implements Presentable
{
    use InteractsWithPresenter;

    public function __construct(
        protected Request $request,
        protected ?ServiceModel $model,
    ) {}

    public function transform(): ServiceData | Data
    {
        return ServiceData::from($this->model);
    }
}
