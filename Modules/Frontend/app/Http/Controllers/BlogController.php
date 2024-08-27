<?php

namespace Modules\Frontend\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Models\Blog;
use Modules\Admin\Models\CategoryBlog;
use Modules\Admin\Models\CmsModels\BlogCms;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with('category')->paginate(6);
        $news = Blog::orderBy('created_at', 'desc')->limit(5)->get();
        $blogCms = BlogCms::first();
        $categories = CategoryBlog::all();
        return view('frontend::pages.blog.index', compact('blogs', 'news', 'blogCms', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $blog = Blog::find($id);
        $news = Blog::orderBy('created_at', 'desc')->limit(5)->get();
        return view('frontend::pages.blog.show', compact('blog', 'news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('frontend::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
