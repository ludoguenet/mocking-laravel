<?php

declare(strict_types=1);

namespace App\Http\Controllers\Post;

use App\DataObjects\Post\PostDataObject;
use App\Enums\PostStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Jobs\Post\IncreaseUserPointsJob;
use App\Mail\Post\PostCreatedMail;
use App\Models\Post;
use http\Exception\RuntimeException;
use Illuminate\Support\Facades\Mail;

class StorePostController extends Controller
{
    public function __invoke(
        StorePostRequest $request,
    ): void {
        $postData = PostDataObject::make(
            request: $request,
        );

        if (auth()->user() === null) {
            throw new RuntimeException('User not authenticated');
        }

        IncreaseUserPointsJob::dispatch(
            [
                ...$postData->toArray(),
                'user_id' => auth()->user()->id,
            ],
        );

        Post::create([
            'title' => $postData->title,
            'status' => PostStatusEnum::DRAFT,
            'user_id' => auth()->user()->id,
        ]);

        Mail::to('admin@nordcoders.fr')->send(
            new PostCreatedMail(
                user: auth()->user(),
            )
        );
    }
}
