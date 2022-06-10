<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ContentController extends Controller
{
    public function content($content_kind, $content_kind_id)
    {
        if (
            request()
                ->user()
                ->hasRole('User Content')
        ) {
            return view('/user/content/content_list')->with([
                'data' => $content_kind,
                'id' => $content_kind_id,
            ]);
        } else {
            return redirect('/admin/home');
        }
    }

    public function read($content, $id)
    {
        if (
            request()
                ->user()
                ->hasRole('User Content')
        ) {
            //$id = $request->id;
            //dd($id);
            $data = Content::where('content_kind_id', '=', $id)->get();
            //$data = DB::table('contents')->where('content_kind_id', '=', 100)->get();

            return view('/user/content/read')->with([
                'data' => $data,
            ]);
        } else {
            return redirect('/admin/home');
        }
    }

    public function create($content_kind, $content_kind_id)
    {
        if (
            request()
                ->user()
                ->hasRole('User Content')
        ) {
            return view('/user/content/create')->with([
                'data' => $content_kind,
                'id' => $content_kind_id,
            ]);
        } else {
            return redirect('/admin/home');
        }
    }

    public function store(Request $request)
    {
        if (
            request()
                ->user()
                ->hasRole('User Content') ||
            request()
                ->user()
                ->hasRole('Admin')
        ) {
            $imageName = time() . '.' . $request->thumbnail->extension();
            $request->thumbnail->move(public_path('images'), $imageName);

            $save = new Content();
            $save->content_kind_id = $request->content_kind_id;
            $save->user_id = $request->user_id;
            $save->name_content = $request->name_content;
            $save->thumbnail = $imageName;
            $save->content = $request->content;
            $save->url = $request->url;

            $save->save();
        } else {
            return redirect('/admin/home');
        }
    }

    public function show($content_kind_id, $id)
    {
        if (
            request()
                ->user()
                ->hasRole('User Content')
        ) {
            $data = Content::findOrFail($id);
            return view('/user/content/edit')->with([
                'data' => $data,
            ]);
        } else {
            return redirect('/admin/home');
        }
    }

    public function update(Request $request, $name, $id)
    {
        if (
            request()
                ->user()
                ->hasRole('User Content')
        ) {
            $data = Content::findOrFail($id);
            $data->name_content = $request->name_content;
            $data->content = $request->content;
            $data->url = $request->url;
            if ($request->file('thumbnail')) {
                $imageName = time() . '.' . $request->thumbnail->extension();
                $request->thumbnail->move(public_path('images'), $imageName);

                $data->thumbnail = $imageName;
            }
            $data->save();
        } else {
            return redirect('/admin/home');
        }
    }

    public function destroy($content_kind_id, $id)
    {
        if (
            request()
                ->user()
                ->hasRole('User Content')
        ) {
            $data = Content::findOrFail($id);
            $data->delete();
        } else {
            return redirect('/admin/home');
        }
    }

    public function priview($content, $id)
    {
        if (
            request()
                ->user()
                ->hasRole('User Content')
        ) {
            $data = Content::findOrFail($id);
            return view('/user/content/priview')->with([
                'data' => $data,
            ]);
        } else {
            return redirect('/admin/home');
        }
    }

    public function detail_input()
    {
        if (
            request()
                ->user()
                ->hasRole('User Content')
        ) {
        } else {
            return redirect('/admin/home');
        }
    }

    public function admin_priview($content, $id)
    {
        $data = Content::findOrFail($id);
        return view('/user/content/priview')->with([
            'data' => $data,
        ]);
    }

    public function admin_show($content_kind_id, $id)
    {
        $data = Content::findOrFail($id);
        return view('/user/content/edit')->with([
            'data' => $data,
        ]);
    }

    public function admin_destroy($content_kind_id, $id)
    {
        if (
            request()
                ->user()
                ->hasRole('User Content')
        ) {
            $data = Content::findOrFail($id);
            $data->delete();
        }
    }

    public function admin_create_content($content_kind, $content_kind_id)
    {
        return view('/user/content/create')->with([
            'data' => $content_kind,
            'id' => $content_kind_id,
        ]);
    }
}
