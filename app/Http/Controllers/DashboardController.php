<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $galeri = DB::table('content_kinds')
            ->join('contents', 'contents.content_kind_id', '=', 'content_kinds.id')
            ->where('content_kinds.name_content_kind', 'like', 'Galeri - %')
            ->limit(3)
            ->get();

        $artikel = DB::table('content_kinds')
            ->join('contents', 'contents.content_kind_id', '=', 'content_kinds.id')
            ->where('content_kinds.name_content_kind', 'like', 'Artikel - %')
            ->limit(3)
            ->get();

        $Banner = DB::table('content_kinds')
            ->join('contents', 'contents.content_kind_id', '=', 'content_kinds.id')
            ->where('content_kinds.name_content_kind', 'like', 'Banner - %')
            ->limit(3)
            ->get();

        $about = DB::table('content_kinds')
            ->join('contents', 'contents.content_kind_id', '=', 'content_kinds.id')
            ->where('content_kinds.name_content_kind', 'like', 'About - %')
            ->orderByDesc('content_kinds.created_at')
            ->limit(1)
            ->get();

        // foreach ($about as $list) {
        //     echo $list->name_content . '<br>';
        // }

        return view('/index')->with([
            'galeri' => $galeri,
            'artikel' => $artikel,
            'banner' => $banner,
            'about' => $about
        ]);
    }

    public function about()
    {
        $about = DB::table('content_kinds')
            ->join('contents', 'contents.content_kind_id', '=', 'content_kinds.id')
            ->where('content_kinds.name_content_kind', 'like', 'About - %')
            ->orderByDesc('content_kinds.created_at')
            ->limit(1)
            ->get();
        return view('/about')->with([
            'data' => $about
        ]);
    }

    public function artikel()
    {
        // $lists = Content::all();

        // foreach ($lists as $list) {
        //     echo $list->name_content . '<br>';
        // }

        return view('/blog')->with([
            'data' => Content::latest()->get()
        ]);
    }

    public function galeri()
    {
        return view('/gallery');
    }
}
