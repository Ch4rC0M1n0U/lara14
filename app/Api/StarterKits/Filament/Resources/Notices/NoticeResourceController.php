<?php

namespace App\Api\StarterKits\Filament\Resources\Notices;

use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;
use XtendPackages\RESTPresenter\Resources\ResourceController;

class NoticeResourceController extends ResourceController
{
    protected static string $model = Notice::class;

    public static bool $isAuthenticated = false;

    public function index(Request $request): Collection
    {
        $notices = $this->getModelQueryInstance()->get();

        return $notices->map(
            fn (Notice $notice) => $this->present($request, $notice),
        );
    }

    public function show(Request $request, Notice $notice): Data
    {
        return $this->present($request, $notice);
    }

    public function filters(): array
    {
        return [
            
        ];
    }

    public function presenters(): array
    {
        return [
            'notice' => Presenters\Notices\NoticePresenter::class,
        ];
    }
}
