<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('roles.create',compact('statuses'));
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

        $role = new Role();
        $role->name = $request['name'];
        $role->slug = Str::slug($request['name']);
        $role->status_id = $request['status_id'];
        $role->user_id = $user_id;

        // Single Image Upload 
        if(file_exists($request['image'])){
            $file = $request['image'];
            // dd($file);
            $fname = $file->getClientOriginalName();
            // dd($fname);//ser1.jpg
            $imagenewname = uniqid($user_id).$role['id'].$fname;
            // dd($imagenewname);
            $file->move(public_path('assets/img/roles/'), $imagenewname);

            $filepath = 'assets/img/roles/'.$imagenewname;
            $role->image = $filepath;
        }


        $role->save();

        session()->flash("success","New Leave Created");

        return redirect(route('roles.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::findOrFail($id);
        return view('roles.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::findOrFail($id);
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('roles.edit')->with('role',$role)->with('statuses',$statuses);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $role = Role::findOrFail($id);
        $role->name = $request['name'];
        $role->slug = Str::slug($request['name']);
        $role->status_id = $request['status_id'];
        $role->user_id = $user_id;



        // Remove Old Single Image 
        

        if($request->hasFile('image')){
            $path = $role->image;
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
            $imagenewname = uniqid($user_id).$role['id'].$fname;
            // dd($imagenewname);
            $file->move(public_path('assets/img/roles/'), $imagenewname);

            $filepath = 'assets/img/roles/'.$imagenewname;
            $role->image = $filepath;
        }


        $role->save();

        session()->flash("success","Update Successfully");

        

        return redirect(route('roles.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);

        // Remove Old Single Image 
        $path = $role->image;

        if(File::exists($path)){
            File::delete($path);
        }

         $role->delete();
         session()->flash("info","Delete Successfully");
         return redirect()->back();
    }
}
