<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Admin\Models\CmsModels\AboutCms;
use Modules\Admin\Models\CmsModels\GalleryCms;
use Modules\Admin\Models\Gallery;

class ProfileController extends Controller
{
    public function index()
    {
        $aboutCms = AboutCms::first();
        return view('frontend::pages.profile.about-me', compact('aboutCms'));
    }

    public function gallery()
    {
        $galleries = Gallery::paginate(10);
        $galleryCms = GalleryCms::first();
        return view('frontend::pages.profile.gallery', compact('galleries', 'galleryCms'));
    }
}
