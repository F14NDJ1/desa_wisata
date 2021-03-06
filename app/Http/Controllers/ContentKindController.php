<?php

namespace App\Http\Controllers;

use App\Models\Content_kind;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ContentKindController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        if (
            request()->user()->hasRole('User Content')
        ) {
            $id = Auth::id();
            $data = Content_kind::where('user_id', $id)->count();
            $data1 = Content::where('user_id', $id)->count();

            return view('/user/home')->with([
                'data' => $data,
                'data1' => $data1,
            ]);
        } else {
            return redirect('/admin/home');
        }
    }

    public function content_kind_list()
    {
        if (
            request()->user()->hasRole('User Content')
        ) {
            return view('/user/contentKind/content_kind_list');
        } else {
            return redirect('/admin/home');
        }
    }

    public function read()
    {
        if (
            request()->user()->hasRole('User Content')
        ) {
            // $content_kind = DB::table('contents')
            //     ->join('users', 2, '=', 'users.user_id')
            //     ->join('content_kind', 'contents.user_id', '=', 'content_kinds.id')
            //     ->select('users.*', 'contacts.phone', 'orders.price')
            //     ->get();
            $id = Auth::id();
            $data = Content_kind::where('user_id', $id)->get();
            // dd($data);
            return view('/user/contentKind/read')->with([
                'data' => $data,
            ]);
        } else {
            return redirect('/admin/home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (
            request()->user()->hasRole('User Content')
        ) {
            return view('/user/contentKind/create');
        } else {
            return redirect('/admin/home');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (
            request()->user()->hasRole('User Content')
        ) {
            $request->validate([
                'name_content_kind' => ['required', 'string', 'max:255'],
                'detail_content_kind' => ['required', 'string', 'max:255'],
            ]);
            Content_kind::create([
                'name_content_kind' => $request->name_content_kind,
                'detail_content_kind' => $request->detail_content_kind,
                'user_id' => $request->user_id,
            ]);
        } else {
            return redirect('/admin/home')->with('alert', 'updated');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (
            request()->user()->hasRole('User Content')
        ) {
            $data = Content_kind::findOrFail($id);
            return view('/user/contentKind/edit')->with([
                'data' => $data,
            ]);
        } else {
            return redirect('/admin/home');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (
            request()->user()->hasRole('User Content')
        ) {
            $request->validate([
                'name_content_kind' => ['required', 'string', 'max:255'],
                'detail_content_kind' => ['required', 'string', 'max:255'],
            ]);

            $data = Content_kind::findOrFail($id);
            $data->name_content_kind = $request->name_content_kind;
            $data->detail_content_kind = $request->detail_content_kind;
            $data->save();
        } else {
            return redirect('/admin/home');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (
            request()->user()->hasRole('User Content')
        ) {
            $data = Content_kind::findOrFail($id);
            $data->delete();
        } else {
            return redirect('/admin/home');
        }
    }

    public function content($content_kind)
    {
        if (
            request()->user()->hasRole('User Content')
        ) {
            return view('/user/content/content_list')->with([
                'data' => $content_kind,
            ]);
        } else {
            return redirect('/admin/home');
        }
    }

    public function admin_content_kind()
    {
        if (
            request()->user()->hasRole('Admin')
        ) {
            return view('/admin/content_kind');
        } else {
            return redirect('/user/home');
        }
    }

    public function read_admin_content_kind()
    {
        if (
            request()->user()->hasRole('Admin')
        ) {
            $data = DB::table('users')
                ->join('content_kinds', 'content_kinds.user_id', '=', 'users.id')
                ->get();
            return view('/admin/read_content_kind')->with([
                'data' => $data,
            ]);
        } else {
            return redirect('/user/home');
        }
    }

    public function admin_view_cntn($kind, $id)
    {
        $data = Content::where('content_kind_id', '=', $id)->get();
        //$data = DB::table('contents')->where('content_kind_id', '=', 100)->get();

        return view('/user/content/read')->with([
            'data' => $data,
            'kind' => $kind,
            'id' => $id
        ]);
    }

    public function admin_show_cntn($id)
    {
        $data = Content_kind::findOrFail($id);
        return view('/user/contentKind/edit')->with([
            'data' => $data,
        ]);
    }

    public function admin_update_cntn(Request $request, $id)
    {
        $request->validate([
            'name_content_kind' => ['required', 'string', 'max:255'],
            'detail_content_kind' => ['required', 'string', 'max:255'],
        ]);

        $data = Content_kind::findOrFail($id);
        $data->name_content_kind = $request->name_content_kind;
        $data->detail_content_kind = $request->detail_content_kind;
        $data->save();
    }

    public function admin_destroy_cntn($id)
    {
        $data = Content_kind::findOrFail($id);
        $data->delete();
    }

    public function admin_create_kind()
    {
        return view('/user/contentKind/create');
    }

    public function admin_store_kind(Request $request)
    {
        $request->validate([
            'name_content_kind' => ['required', 'string', 'max:255'],
            'detail_content_kind' => ['required', 'string', 'max:255'],
        ]);
        Content_kind::create([
            'name_content_kind' => $request->name_content_kind,
            'detail_content_kind' => $request->detail_content_kind,
            'user_id' => $request->user_id,
        ]);
    }
}
