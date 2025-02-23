<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Models\Announcement;
use App\Models\Post;
use App\Models\Status;
use Illuminate\Support\Str;
use App\Models\User;
use App\Notifications\AnnouncementEmailNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Response;
use Exception;

class AnnouncementsController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $announcements = Announcement::paginate(5);

        $statusfilter = $request->input('statusfilter');
        $namefilter = $request['namefilter'];

        $query = Announcement::query();

        if($statusfilter){
            $query->where('status_id',$statusfilter);
        }

        if($namefilter){
            $query->where('title','like','%'.$namefilter.'%');
        }

        $announcements = $query->paginate(5)->appends($request->except('page'));

        $statuses = Status::whereIn('id',[3,4])->get();
        return view('announcements.index',compact('announcements','statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $posts = Post::where('attshow',3)->orderBy('title','asc')->get()->pluck('title','id');
        return view('announcements.create',compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'image'=>'image|mimes:jpg,jpeg,png|max:1024',
            'title'=>'required|max:100',
            'content'=>'required'
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $announcement = new Announcement();
        $announcement->title = $request['title'];
        $announcement->content = $request['content'];
        $announcement->post_id = json_encode($request['post_id']);
        $announcement->user_id = $user_id;

        // Single Image Upload 
        if(file_exists($request['image'])){
            $file = $request['image'];
            // dd($file);
            $fname = $file->getClientOriginalName();
            // dd($fname);//ser1.jpg
            $imagenewname = uniqid($user_id).$announcement['id'].$fname;
            // dd($imagenewname);
            $file->move(public_path('assets/img/announcements/'), $imagenewname);

            $filepath = 'assets/img/announcements/'.$imagenewname;
            $announcement->image = $filepath;
        }


        $announcement->save();

        //Sent Email Notification to all users
        $users = User::all();
        Notification::send($users,new AnnouncementEmailNotify($announcement->id,$announcement->title,$announcement->content));


        session()->flash("success","New Announcement Created");

        return redirect(route('announcements.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('announcements.show',compact('announcement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $announcement = Announcement::findOrFail($id);
        $posts = Post::where('attshow',3)->orderBy('title','asc')->get()->pluck('title','id');
        return view('announcements.edit')->with('announcement',$announcement)->with('posts',$posts);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $this->validate($request,[
            'image'=>'image|mimes:jpg,jpeg,png|max:1024',
            'title'=>'required|max:100',
            'content'=>'required'
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $announcement = Announcement::findOrFail($id);
        $announcement->title = $request['title'];
        $announcement->content = $request['content'];
        $announcement->post_id = $request['post_id'];
        $announcement->user_id = $user_id;



        // Remove Old Single Image 
        

        if($request->hasFile('image')){
            $path = $announcement->image;
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
            $imagenewname = uniqid($user_id).$announcement['id'].$fname;
            // dd($imagenewname);
            $file->move(public_path('assets/img/announcements/'), $imagenewname);

            $filepath = 'assets/img/announcements/'.$imagenewname;
            $announcement->image = $filepath;
        }


        $announcement->save();

        session()->flash("success","Update Successfully");
        return redirect(route('announcements.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $announcement = Announcement::findOrFail($id);

        // Remove Old Single Image 
        $path = $announcement->image;

        if(File::exists($path)){
            File::delete($path);
        }

         $announcement->delete();
         session()->flash("info","Delete Successfully");
         return redirect()->back();
    }

    public function bulkdeletes(Request $request){
        try{
            $getselectedids = $request->selectedids;
            Announcement::whereIn('id',$getselectedids)->delete();
            return Response::json(["success"=>"Selected data have been deleted successfully."]);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"Failed.","message"=>$e->getMessage()]);
        }
    }
}
