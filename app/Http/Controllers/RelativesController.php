<?php

namespace App\Http\Controllers;

use App\Models\Relative;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class RelativesController extends Controller
{
    public function index()
    {
        $relatives = Relative::all();
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('relatives.index',compact('relatives'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('relatives.create',compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'image'=>'image|mimes:jpg,jpeg,png|max:1024',
            'name'=>'required|max:50|unique:roles,name',
            'status_id'=>'required|in:3,4'
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $relative = new Relative();
        $relative->name = $request['name'];
        $relative->slug = Str::slug($request['name']);
        $relative->status_id = $request['status_id'];
        $relative->user_id = $user_id;

        $relative->save();

        session()->flash("success","New Leave Created");

        return redirect(route('relatives.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $relative = Relative::findOrFail($id);
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('relatives.edit')->with('relative',$relative)->with('statuses',$statuses);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $relative = Relative::findOrFail($id);
        $relative->name = $request['name'];
        $relative->slug = Str::slug($request['name']);
        $relative->status_id = $request['status_id'];
        $relative->user_id = $user_id;



        // Remove Old Single Image 
        

        // if($request->hasFile('image')){
        //     $path = $role->image;
        //     if(File::exists($path)){
        //         File::delete($path);
        //     }
        // }

        // // Single Image Upload 
        // if(file_exists($request['image'])){
        //     $file = $request['image'];
        //     // dd($file);
        //     $fname = $file->getClientOriginalName();
        //     // dd($fname);//ser1.jpg
        //     $imagenewname = uniqid($user_id).$role['id'].$fname;
        //     // dd($imagenewname);
        //     $file->move(public_path('assets/img/roles/'), $imagenewname);

        //     $filepath = 'assets/img/roles/'.$imagenewname;
        //     $role->image = $filepath;
        // }


        $relative->save();

        session()->flash("success","Update Successfully");

        

        return redirect(route('relatives.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $relative = Relative::findOrFail($id);

        // Remove Old Single Image 
        // $path = $role->image;

        // if(File::exists($path)){
        //     File::delete($path);
        // }

         $relative->delete();
         session()->flash("info","Delete Successfully");
         return redirect()->back();
    }
}
