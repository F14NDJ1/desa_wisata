<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $content = new Content();
        $content->id = 0;
        $content->exists = true;
        $image = $content->addMediaFromRequest('upload')->toMediaCollection('images');


        return response()->json([
            'url' => $image->getUrl()
        ]);
    }
}
