<?php

use App\Api\StarterKits\Filament\Resources\Cells\Presenters\Cells\Data\CellData as DataResponse;
use App\Models\Cell as Cell;

use function Pest\Laravel\getJson;

beforeEach(function (): void {
    $this->cells = Cell::factory(10)->create();
});

describe('Cell', function (): void {
    test('can show a cell', function (): void {

        $cell = $this->cells->random();

        $response = getJson(
            uri: route('api.v1.filament.cells.show', $cell),
            headers: [
                'x-rest-presenter-api-key' => config('rest-presenter.auth.key'),
                'x-rest-presenter' => 'Cell'
            ],
        )->assertOk()->json();

        expect($response)
            ->toMatchArray(
                array: DataResponse::from($cell)->toArray(),
                message: 'Response data is in the expected format',
            );
    });

    test('can list all cells', function (): void {
        $response = getJson(
            uri: route('api.v1.filament.cells.index'),
            headers: [
                'x-rest-presenter-api-key' => config('rest-presenter.auth.key'),
                'x-rest-presenter' => 'Cell'
            ],
        )->assertOk()->json();

        expect($response)
            ->toMatchArray(
                array: DataResponse::collect($this->cells)->toArray(),
                message: 'Response data is in the expected format',
            )
            ->toHaveCount($this->cells->count());
    });
});
