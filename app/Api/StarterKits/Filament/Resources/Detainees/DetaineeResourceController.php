<?php

namespace App\Api\StarterKits\Filament\Resources\Detainees;

use App\Models\Detainee;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;
use XtendPackages\RESTPresenter\Resources\ResourceController;

class DetaineeResourceController extends ResourceController
{
    protected static string $model = Detainee::class;

    public static bool $isAuthenticated = false;

    public function index(Request $request): Collection
    {
        $detainees = $this->getModelQueryInstance()->get();

        return $detainees->map(
            fn (Detainee $detainee) => $this->present($request, $detainee),
        );
    }

    public function show(Request $request, Detainee $detainee): Data
    {
        return $this->present($request, $detainee);
    }

    public function filters(): array
    {
        return [
            
        ];
    }

    public function presenters(): array
    {
        return [
            'detainee' => Presenters\Detainees\DetaineePresenter::class,
        ];
    }
}
