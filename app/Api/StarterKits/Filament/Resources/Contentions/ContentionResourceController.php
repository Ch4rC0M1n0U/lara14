<?php

namespace App\Api\StarterKits\Filament\Resources\Contentions;

use App\Models\Contention;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;
use XtendPackages\RESTPresenter\Resources\ResourceController;

class ContentionResourceController extends ResourceController
{
    protected static string $model = Contention::class;

    public static bool $isAuthenticated = false;

    public function index(Request $request): Collection
    {
        $contentions = $this->getModelQueryInstance()->get();

        return $contentions->map(
            fn (Contention $contention) => $this->present($request, $contention),
        );
    }

    public function show(Request $request, Contention $contention): Data
    {
        return $this->present($request, $contention);
    }

    public function filters(): array
    {
        return [
            
        ];
    }

    public function presenters(): array
    {
        return [
            'contention' => Presenters\Contentions\ContentionPresenter::class,
        ];
    }
}
