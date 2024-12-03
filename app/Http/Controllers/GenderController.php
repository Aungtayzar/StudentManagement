<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Models\Gender;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GenderController extends Controller
{
    public function index()
    {
        $genders = Gender::all();
        $statuses = Status::whereIn('id',[1,4])->get();
        return view('genders.index',compact('genders','statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'status_id'=>'required|in:1,4'
        ]);
        
        $user = Auth::user();
        $user_id = $user->id;

        $gender = new Gender();
        $gender->name = $request['name'];
        $gender->slug = Str::slug($request['name']);
        $gender->status_id = $request['status_id'];
        $gender->user_id = $user_id;

        $gender->save();

        return redirect(route('genders.index'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $gender = Gender::findOrFail($id);
        $gender->name = $request['name'];
        $gender->slug = Str::slug($request['name']);
        $gender->status_id = $request['status_id'];
        $gender->user_id = $user_id;

        $gender->save();

        return redirect(route('genders.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gender = Gender::findOrFail($id);
        $gender->delete();
        return redirect()->back();
    }
}
