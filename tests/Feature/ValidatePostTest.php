<?php

declare(strict_types=1);

use App\Enums\PostStatusEnum;
use App\Models\Post;
use App\Service\PdfGeneratorService;
use Mockery\MockInterface;

it('validates a post', function () {
    $this->mock(
        PdfGeneratorService::class, function (MockInterface $mock) {
            $mock->shouldReceive('execute')->once();
        });

    \Pest\Laravel\post(
        uri: route('posts.validate', [
            'post' => $post = Post::factory()->create(),
        ])
    )->assertRedirect();

    expect($post->refresh()->status)->toEqual(PostStatusEnum::VALIDATED);
});
