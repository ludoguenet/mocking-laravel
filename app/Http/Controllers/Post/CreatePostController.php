<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CreatePostController extends Controller
{
    public function __invoke(
        Request $request,
    ): View {
        return view('posts.create');
    }
}
