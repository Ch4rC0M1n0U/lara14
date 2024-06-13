<?php

use App\Api\StarterKits\Filament\Resources\Notices\Presenters\Notices\Data\NoticeData as DataResponse;
use App\Models\Notice as Notice;

use function Pest\Laravel\getJson;

beforeEach(function (): void {
    $this->notices = Notice::factory(10)->create();
});

describe('Notice', function (): void {
    test('can show a notice', function (): void {

        $notice = $this->notices->random();

        $response = getJson(
            uri: route('api.v1.filament.notices.show', $notice),
            headers: [
                'x-rest-presenter-api-key' => config('rest-presenter.auth.key'),
                'x-rest-presenter' => 'Notice'
            ],
        )->assertOk()->json();

        expect($response)
            ->toMatchArray(
                array: DataResponse::from($notice)->toArray(),
                message: 'Response data is in the expected format',
            );
    });

    test('can list all notices', function (): void {
        $response = getJson(
            uri: route('api.v1.filament.notices.index'),
            headers: [
                'x-rest-presenter-api-key' => config('rest-presenter.auth.key'),
                'x-rest-presenter' => 'Notice'
            ],
        )->assertOk()->json();

        expect($response)
            ->toMatchArray(
                array: DataResponse::collect($this->notices)->toArray(),
                message: 'Response data is in the expected format',
            )
            ->toHaveCount($this->notices->count());
    });
});
