<?php

namespace App\Api\StarterKits\Filament\Resources\Liberations;

use App\Models\Liberation;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;
use XtendPackages\RESTPresenter\Resources\ResourceController;

class LiberationResourceController extends ResourceController
{
    protected static string $model = Liberation::class;

    public static bool $isAuthenticated = false;

    public function index(Request $request): Collection
    {
        $liberations = $this->getModelQueryInstance()->get();

        return $liberations->map(
            fn (Liberation $liberation) => $this->present($request, $liberation),
        );
    }

    public function show(Request $request, Liberation $liberation): Data
    {
        return $this->present($request, $liberation);
    }

    public function filters(): array
    {
        return [
            
        ];
    }

    public function presenters(): array
    {
        return [
            'liberation' => Presenters\Liberations\LiberationPresenter::class,
        ];
    }
}
