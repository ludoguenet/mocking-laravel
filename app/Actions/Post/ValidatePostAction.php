<?php

declare(strict_types=1);

namespace App\Actions\Post;

use App\Enums\PostStatusEnum;
use App\Models\Post;

final class ValidatePostAction
{
    public function __invoke(
        Post $post,
    ): Post {
        if ($post->status === PostStatusEnum::VALIDATED) {
            return $post;
        }

        $post->status = PostStatusEnum::VALIDATED;
        $post->save();

        return $post->refresh();
    }
}
