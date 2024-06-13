<?php

use App\Api\StarterKits\Filament\Resources\Services\Presenters\Services\Data\ServiceData as DataResponse;
use App\Models\Service as Service;

use function Pest\Laravel\getJson;

beforeEach(function (): void {
    $this->services = Service::factory(10)->create();
});

describe('Service', function (): void {
    test('can show a service', function (): void {

        $service = $this->services->random();

        $response = getJson(
            uri: route('api.v1.filament.services.show', $service),
            headers: [
                'x-rest-presenter-api-key' => config('rest-presenter.auth.key'),
                'x-rest-presenter' => 'Service'
            ],
        )->assertOk()->json();

        expect($response)
            ->toMatchArray(
                array: DataResponse::from($service)->toArray(),
                message: 'Response data is in the expected format',
            );
    });

    test('can list all services', function (): void {
        $response = getJson(
            uri: route('api.v1.filament.services.index'),
            headers: [
                'x-rest-presenter-api-key' => config('rest-presenter.auth.key'),
                'x-rest-presenter' => 'Service'
            ],
        )->assertOk()->json();

        expect($response)
            ->toMatchArray(
                array: DataResponse::collect($this->services)->toArray(),
                message: 'Response data is in the expected format',
            )
            ->toHaveCount($this->services->count());
    });
});
