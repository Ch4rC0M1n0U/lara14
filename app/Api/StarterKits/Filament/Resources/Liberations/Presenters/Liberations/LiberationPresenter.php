<?php

namespace App\Api\StarterKits\Filament\Resources\Liberations\Presenters\Liberations;

use App\Api\StarterKits\Filament\Resources\Liberations\Presenters\Liberations\Data\LiberationData;
use App\Models\Liberation as LiberationModel;
use Illuminate\Http\Request;
use Spatie\LaravelData\Data;
use XtendPackages\RESTPresenter\Concerns\InteractsWithPresenter;
use XtendPackages\RESTPresenter\Contracts\Presentable;

class LiberationPresenter implements Presentable
{
    use InteractsWithPresenter;

    public function __construct(
        protected Request $request,
        protected ?LiberationModel $model,
    ) {}

    public function transform(): LiberationData | Data
    {
        return LiberationData::from($this->model);
    }
}
