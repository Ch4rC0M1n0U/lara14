<?php

namespace App\Api\StarterKits\Filament\Resources\Services;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;
use XtendPackages\RESTPresenter\Resources\ResourceController;

class ServiceResourceController extends ResourceController
{
    protected static string $model = Service::class;

    public static bool $isAuthenticated = false;

    public function index(Request $request): Collection
    {
        $services = $this->getModelQueryInstance()->get();

        return $services->map(
            fn (Service $service) => $this->present($request, $service),
        );
    }

    public function show(Request $request, Service $service): Data
    {
        return $this->present($request, $service);
    }

    public function filters(): array
    {
        return [
            
        ];
    }

    public function presenters(): array
    {
        return [
            'service' => Presenters\Services\ServicePresenter::class,
        ];
    }
}
