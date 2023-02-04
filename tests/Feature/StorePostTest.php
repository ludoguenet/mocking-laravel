<?php

declare(strict_types=1);

use App\Jobs\Post\IncreaseUserPointsJob;
use App\Mail\Post\PostCreatedMail;
use App\Models\User;
use function Pest\Faker\faker;
use function Pest\Laravel\actingAs;

it('stores a post', function () {
    Bus::fake();
    Mail::fake();

    actingAs(User::factory()->create())
        ->post(
            uri: route('posts.store', [
                'title' => faker()->sentence,
            ])
        )->assertOk();

    Bus::assertDispatched(IncreaseUserPointsJob::class);

    Mail::assertSent(PostCreatedMail::class);
});
