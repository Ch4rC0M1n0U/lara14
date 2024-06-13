<?php

namespace App\Api\StarterKits\Filament\Resources\Contentions\Presenters\Contentions;

use App\Api\StarterKits\Filament\Resources\Contentions\Presenters\Contentions\Data\ContentionData;
use App\Models\Contention as ContentionModel;
use Illuminate\Http\Request;
use Spatie\LaravelData\Data;
use XtendPackages\RESTPresenter\Concerns\InteractsWithPresenter;
use XtendPackages\RESTPresenter\Contracts\Presentable;

class ContentionPresenter implements Presentable
{
    use InteractsWithPresenter;

    public function __construct(
        protected Request $request,
        protected ?ContentionModel $model,
    ) {}

    public function transform(): ContentionData | Data
    {
        return ContentionData::from($this->model);
    }
}
