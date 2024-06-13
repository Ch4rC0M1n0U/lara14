<?php

use App\Api\StarterKits\Filament\Resources\Liberations\Presenters\Liberations\Data\LiberationData as DataResponse;
use App\Models\Liberation as Liberation;

use function Pest\Laravel\getJson;

beforeEach(function (): void {
    $this->liberations = Liberation::factory(10)->create();
});

describe('Liberation', function (): void {
    test('can show a liberation', function (): void {

        $liberation = $this->liberations->random();

        $response = getJson(
            uri: route('api.v1.filament.liberations.show', $liberation),
            headers: [
                'x-rest-presenter-api-key' => config('rest-presenter.auth.key'),
                'x-rest-presenter' => 'Liberation'
            ],
        )->assertOk()->json();

        expect($response)
            ->toMatchArray(
                array: DataResponse::from($liberation)->toArray(),
                message: 'Response data is in the expected format',
            );
    });

    test('can list all liberations', function (): void {
        $response = getJson(
            uri: route('api.v1.filament.liberations.index'),
            headers: [
                'x-rest-presenter-api-key' => config('rest-presenter.auth.key'),
                'x-rest-presenter' => 'Liberation'
            ],
        )->assertOk()->json();

        expect($response)
            ->toMatchArray(
                array: DataResponse::collect($this->liberations)->toArray(),
                message: 'Response data is in the expected format',
            )
            ->toHaveCount($this->liberations->count());
    });
});
