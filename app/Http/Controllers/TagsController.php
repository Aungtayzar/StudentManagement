<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use App\Models\Status;
use Illuminate\Support\Str;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('tags.create',compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'image'=>'image|mimes:jpg,jpeg,png|max:1024',
            'name'=>'required',
            'status_id'=>'required|in:3,4'
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $tag = new Tag();
        $tag->name = $request['name'];
        $tag->slug = Str::slug($request['name']);
        $tag->status_id = $request['status_id'];
        $tag->user_id = $user_id;

        // Single Image Upload 
        if(file_exists($request['image'])){
            $file = $request['image'];
            // dd($file);
            $fname = $file->getClientOriginalName();
            // dd($fname);//ser1.jpg
            $imagenewname = uniqid($user_id).$tag['id'].$fname;
            // dd($imagenewname);
            $file->move(public_path('assets/img/roles/'), $imagenewname);

            $filepath = 'assets/img/roles/'.$imagenewname;
            $tag->image = $filepath;
        }


        $tag->save();

        return redirect(route('tags.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tag = Tag::findOrFail($id);
        return view('tags.show',compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tag = Tag::findOrFail($id);
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('tags.edit')->with('tag',$tag)->with('statuses',$statuses);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $tag = Tag::findOrFail($id);
        $tag->name = $request['name'];
        $tag->slug = Str::slug($request['name']);
        $tag->status_id = $request['status_id'];
        $tag->user_id = $user_id;



        // Remove Old Single Image 
        

        if($request->hasFile('image')){
            $path = $tag->image;
            if(File::exists($path)){
                File::delete($path);
            }
        }

        // Single Image Upload 
        if(file_exists($request['image'])){
            $file = $request['image'];
            // dd($file);
            $fname = $file->getClientOriginalName();
            // dd($fname);//ser1.jpg
            $imagenewname = uniqid($user_id).$tag['id'].$fname;
            // dd($imagenewname);
            $file->move(public_path('assets/img/roles/'), $imagenewname);

            $filepath = 'assets/img/roles/'.$imagenewname;
            $tag->image = $filepath;
        }


        $tag->save();

        return redirect(route('tags.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
