<?php

namespace App\Api\StarterKits\Filament\Resources\Cells;

use App\Models\Cell;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;
use XtendPackages\RESTPresenter\Resources\ResourceController;

class CellResourceController extends ResourceController
{
    protected static string $model = Cell::class;

    public static bool $isAuthenticated = false;

    public function index(Request $request): Collection
    {
        $cells = $this->getModelQueryInstance()->get();

        return $cells->map(
            fn (Cell $cell) => $this->present($request, $cell),
        );
    }

    public function show(Request $request, Cell $cell): Data
    {
        return $this->present($request, $cell);
    }

    public function filters(): array
    {
        return [
            
        ];
    }

    public function presenters(): array
    {
        return [
            'cell' => Presenters\Cells\CellPresenter::class,
        ];
    }
}
