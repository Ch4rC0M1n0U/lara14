<?php

namespace App\Api\StarterKits\Filament\Resources\PrivLibs;

use App\Models\PrivLib;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;
use XtendPackages\RESTPresenter\Resources\ResourceController;

class PrivLibResourceController extends ResourceController
{
    protected static string $model = PrivLib::class;

    public static bool $isAuthenticated = false;

    public function index(Request $request): Collection
    {
        $privLibs = $this->getModelQueryInstance()->get();

        return $privLibs->map(
            fn (PrivLib $privLib) => $this->present($request, $privLib),
        );
    }

    public function show(Request $request, PrivLib $privLib): Data
    {
        return $this->present($request, $privLib);
    }

    public function filters(): array
    {
        return [
            
        ];
    }

    public function presenters(): array
    {
        return [
            'priv-lib' => Presenters\PrivLibs\PrivLibPresenter::class,
        ];
    }
}
