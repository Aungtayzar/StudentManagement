<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

class LeavesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaves = Leave::all();
        return view('leaves.index',compact('leaves'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $data['posts'] = Post::where('attshow',3)->orderBy('title','asc')->get();
        $data['tags'] = User::orderBy('name','asc')->get();
        $data['gettoday'] = Carbon::today()->format('Y-m-d');
        // dd($data['gettoday']);
        return view('leaves.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'post_id'=>'required',
            'startdate'=>'required|date',
            'enddate'=>'required|date',
            'tag'=>'required',
            'title'=>'required|max:100',
            'content'=>'required'
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $leave = new Leave();
        $leave->post_id = $request['post_id'];
        $leave->startdate = $request['startdate'];
        $leave->enddate = $request['enddate'];
        $leave->tag = $request['tag'];
        $leave->title = $request['title'];
        $leave->content = $request['content'];
        $leave->user_id = $user_id;

        


        $leave->save();

        return redirect(route('leaves.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['leave'] = Leave::findOrFail($id);
        $data['posts'] = Post::where('attshow',3)->orderBy('title','asc')->get();
        $data['tags'] = User::orderBy('name','asc')->get();
        return view('leaves.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $leave = Leave::findOrFail($id);
        $leave->post_id = $request['post_id'];
        $leave->startdate = $request['startdate'];
        $leave->enddate = $request['enddate'];
        $leave->tag = $request['tag'];
        $leave->title = $request['title'];
        $leave->content = $request['content'];

        $leave->save();

        return redirect(route('leaves.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $leave = Leave::findOrFail($id);
        $leave->delete();
        return redirect()->back();
    }
}
