<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Status;
use Illuminate\Support\Str;
use App\Models\Type;
use Illuminate\Http\Request;


class TypesController extends Controller
{
    public function index()
    {
        $types = Type::all();
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('types.index',compact('types','statuses'));
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
            'name'=>'required|max:50|unique:types,name',
            'status_id'=>'required|in:3,4'
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $type = new Type();
        $type->name = $request['name'];
        $type->slug = Str::slug($request['name']);
        $type->status_id = $request['status_id'];
        $type->user_id = $user_id;

        $type->save();

        return redirect(route('types.index'));
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

        $type = Type::findOrFail($id);
        $type->name = $request['name'];
        $type->slug = Str::slug($request['name']);
        $type->status_id = $request['status_id'];
        $type->user_id = $user_id;

        $type->save();

        return redirect(route('types.index'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $type = Type::findOrFail($id);
         $type->delete();
         return redirect()->back();
    }
}
