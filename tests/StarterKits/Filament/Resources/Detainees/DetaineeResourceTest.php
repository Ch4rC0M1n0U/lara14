<?php

use App\Api\StarterKits\Filament\Resources\Detainees\Presenters\Detainees\Data\DetaineeData as DataResponse;
use App\Models\Detainee as Detainee;

use function Pest\Laravel\getJson;

beforeEach(function (): void {
    $this->detainees = Detainee::factory(10)->create();
});

describe('Detainee', function (): void {
    test('can show a detainee', function (): void {

        $detainee = $this->detainees->random();

        $response = getJson(
            uri: route('api.v1.filament.detainees.show', $detainee),
            headers: [
                'x-rest-presenter-api-key' => config('rest-presenter.auth.key'),
                'x-rest-presenter' => 'Detainee'
            ],
        )->assertOk()->json();

        expect($response)
            ->toMatchArray(
                array: DataResponse::from($detainee)->toArray(),
                message: 'Response data is in the expected format',
            );
    });

    test('can list all detainees', function (): void {
        $response = getJson(
            uri: route('api.v1.filament.detainees.index'),
            headers: [
                'x-rest-presenter-api-key' => config('rest-presenter.auth.key'),
                'x-rest-presenter' => 'Detainee'
            ],
        )->assertOk()->json();

        expect($response)
            ->toMatchArray(
                array: DataResponse::collect($this->detainees)->toArray(),
                message: 'Response data is in the expected format',
            )
            ->toHaveCount($this->detainees->count());
    });
});
