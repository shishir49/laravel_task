<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class WebsiteController extends Controller
{
    public function landingPage() {
        $data = Blog::with('users')->where('status', 'Active')->get();
        return view('modules.website.landingPage', compact('data'));
    }

    public function blog(Request $request, $id) {
        $data = Blog::with('users')->where('status', 'Active')->where('id', $id)->first();
        return view('modules.website.singleBlogPage', compact('data'));
    }
}
