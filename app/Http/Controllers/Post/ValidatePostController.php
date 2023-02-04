<?php

namespace App\Http\Controllers\Post;

use App\Actions\Post\ValidatePostAction;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Service\PdfGeneratorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ValidatePostController extends Controller
{
    public function __invoke(
        Request $request,
        Post $post,
    ): RedirectResponse {
        $post = (new ValidatePostAction)(
            post: $post,
        );

        app(abstract: PdfGeneratorService::class)
            ->execute(
                template: 'pdf.post',
                data: [
                    'post' => $post,
                ],
            );

        return redirect()->back();
    }
}
