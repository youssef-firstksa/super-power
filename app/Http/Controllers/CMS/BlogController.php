<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view('pages.cms.blog.index');
    }

    public function show(Blog $blog)
    {
        return view('pages.cms.blog.show', compact('blog'));
    }
}
