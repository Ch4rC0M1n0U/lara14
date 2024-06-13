<?php

namespace App\Api\StarterKits\Filament\Resources\Detainees\Presenters\Detainees;

use App\Api\StarterKits\Filament\Resources\Detainees\Presenters\Detainees\Data\DetaineeData;
use App\Models\Detainee as DetaineeModel;
use Illuminate\Http\Request;
use Spatie\LaravelData\Data;
use XtendPackages\RESTPresenter\Concerns\InteractsWithPresenter;
use XtendPackages\RESTPresenter\Contracts\Presentable;

class DetaineePresenter implements Presentable
{
    use InteractsWithPresenter;

    public function __construct(
        protected Request $request,
        protected ?DetaineeModel $model,
    ) {}

    public function transform(): DetaineeData | Data
    {
        return DetaineeData::from($this->model);
    }
}
