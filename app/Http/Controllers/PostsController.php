<?php

namespace App\Http\Controllers;

use App\Models\Day;
use Illuminate\Support\Facades\File;
use App\Models\Post;
use App\Models\Status;
use App\Models\Tag;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $attshows = Status::whereIn('id',[3,4])->get();
        $days = Day::where('status_id',3)->get();
        $statuses = Status::whereIn('id',[7,10,11])->get();
        $tags = Tag::where('status_id',3)->get();
        $types = Type::whereIn('id',[1,2])->get();
        return view('posts.create',compact('attshows','days','statuses','tags','types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'image'=>'image|mimes:jpg,jpeg,png|max:1024',
            'title'=>'required|max:300,unique:posts,title',
            'tag'=>'required',
            'startdate'=>'required|date',
            'enddate'=>'required|date',
            'starttime'=>'required|time',
            'endtime'=>'required|time',
            'type_id'=>'required|in:1,2',
            'tag_id'=>'required',
            'attshow'=>'required|in:3,4',
            'status_id'=>'required|in:7,10,11',

        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $post = new Post();
        $post->title = $request['title'];
        $post->slug = Str::slug($request['name']);
        $post->content = $request['content'];
        $post->fee = $request['fee'];
        $post->startdate = $request['startdate'];
        $post->enddate = $request['enddate'];
        $post->starttime = $request['starttime'];
        $post->endtime = $request['endtime'];
        $post->type_id = $request['type_id'];
        $post->tag_id = $request['tag_id'];
        $post->attshow = $request['attshow'];
        $post->status_id = $request['status_id'];
        $post->user_id = $user_id;

        // Single Image Upload 
        if(file_exists($request['image'])){
            $file = $request['image'];
            // dd($file);
            $fname = $file->getClientOriginalName();
            // dd($fname);//ser1.jpg
            $imagenewname = uniqid($user_id).$post['id'].$fname;
            // dd($imagenewname);
            $file->move(public_path('assets/img/posts/'), $imagenewname);

            $filepath = 'assets/img/posts/'.$imagenewname;
            $post->image = $filepath;
        }


        $post->save();

        return redirect(route('posts.index'));
        



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $post = Post::findOrFail($id);
        $post->title = $request['title'];
        $post->slug = Str::slug($request['name']);
        $post->content = $request['content'];
        $post->fee = $request['fee'];
        $post->startdate = $request['startdate'];
        $post->enddate = $request['enddate'];
        $post->starttime = $request['starttime'];
        $post->endtime = $request['endtime'];
        $post->type_id = $request['type_id'];
        $post->tag_id = $request['tag_id'];
        $post->attshow = $request['attshow'];
        $post->status_id = $request['status_id'];
        $post->user_id = $user_id;

        // Remove Old Single Image 
        

        if($request->hasFile('image')){
            $path = $post->image;
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
            $imagenewname = uniqid($user_id).$post['id'].$fname;
            // dd($imagenewname);
            $file->move(public_path('assets/img/posts/'), $imagenewname);

            $filepath = 'assets/img/posts/'.$imagenewname;
            $post->image = $filepath;
        }


        $post->save();

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->back();
    }
}
