<?php

use App\Api\StarterKits\Filament\Resources\PrivLibs\Presenters\PrivLibs\Data\PrivLibData as DataResponse;
use App\Models\PrivLib as PrivLib;

use function Pest\Laravel\getJson;

beforeEach(function (): void {
    $this->privLibs = PrivLib::factory(10)->create();
});

describe('PrivLib', function (): void {
    test('can show a privLib', function (): void {

        $privLib = $this->privLibs->random();

        $response = getJson(
            uri: route('api.v1.filament.privLibs.show', $privLib),
            headers: [
                'x-rest-presenter-api-key' => config('rest-presenter.auth.key'),
                'x-rest-presenter' => 'PrivLib'
            ],
        )->assertOk()->json();

        expect($response)
            ->toMatchArray(
                array: DataResponse::from($privLib)->toArray(),
                message: 'Response data is in the expected format',
            );
    });

    test('can list all privLibs', function (): void {
        $response = getJson(
            uri: route('api.v1.filament.privLibs.index'),
            headers: [
                'x-rest-presenter-api-key' => config('rest-presenter.auth.key'),
                'x-rest-presenter' => 'PrivLib'
            ],
        )->assertOk()->json();

        expect($response)
            ->toMatchArray(
                array: DataResponse::collect($this->privLibs)->toArray(),
                message: 'Response data is in the expected format',
            )
            ->toHaveCount($this->privLibs->count());
    });
});
