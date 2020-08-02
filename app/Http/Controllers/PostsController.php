<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function contact() {
        return view('contact');
    }

    public function show_post($id, $name) {
        return view('Post', compact('id', 'name'));
    }
}
