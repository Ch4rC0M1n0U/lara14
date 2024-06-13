<?php

use App\Api\StarterKits\Filament\Resources\Contentions\Presenters\Contentions\Data\ContentionData as DataResponse;
use App\Models\Contention as Contention;

use function Pest\Laravel\getJson;

beforeEach(function (): void {
    $this->contentions = Contention::factory(10)->create();
});

describe('Contention', function (): void {
    test('can show a contention', function (): void {

        $contention = $this->contentions->random();

        $response = getJson(
            uri: route('api.v1.filament.contentions.show', $contention),
            headers: [
                'x-rest-presenter-api-key' => config('rest-presenter.auth.key'),
                'x-rest-presenter' => 'Contention'
            ],
        )->assertOk()->json();

        expect($response)
            ->toMatchArray(
                array: DataResponse::from($contention)->toArray(),
                message: 'Response data is in the expected format',
            );
    });

    test('can list all contentions', function (): void {
        $response = getJson(
            uri: route('api.v1.filament.contentions.index'),
            headers: [
                'x-rest-presenter-api-key' => config('rest-presenter.auth.key'),
                'x-rest-presenter' => 'Contention'
            ],
        )->assertOk()->json();

        expect($response)
            ->toMatchArray(
                array: DataResponse::collect($this->contentions)->toArray(),
                message: 'Response data is in the expected format',
            )
            ->toHaveCount($this->contentions->count());
    });
});
