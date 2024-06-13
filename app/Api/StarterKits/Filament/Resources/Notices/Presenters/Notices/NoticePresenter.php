<?php

namespace App\Api\StarterKits\Filament\Resources\Notices\Presenters\Notices;

use App\Api\StarterKits\Filament\Resources\Notices\Presenters\Notices\Data\NoticeData;
use App\Models\Notice as NoticeModel;
use Illuminate\Http\Request;
use Spatie\LaravelData\Data;
use XtendPackages\RESTPresenter\Concerns\InteractsWithPresenter;
use XtendPackages\RESTPresenter\Contracts\Presentable;

class NoticePresenter implements Presentable
{
    use InteractsWithPresenter;

    public function __construct(
        protected Request $request,
        protected ?NoticeModel $model,
    ) {}

    public function transform(): NoticeData | Data
    {
        return NoticeData::from($this->model);
    }
}
