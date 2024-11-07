<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Stage;
use App\Models\Status;
use Illuminate\Support\Str;


class StageController extends Controller
{
    public function index()
    {
        $stages = Stage::all();
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('stages.index',compact('stages','statuses'));
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
        $user = Auth::user();
        $user_id = $user->id;

        $stage = new Stage();
        $stage->name = $request['name'];
        $stage->slug = Str::slug($request['name']);
        $stage->status_id = $request['status_id'];
        $stage->user_id = $user_id;

        $stage->save();

        return redirect(route('stages.index'));
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

        $stage = Stage::findOrFail($id);
        $stage->name = $request['name'];
        $stage->slug = Str::slug($request['name']);
        $stage->status_id = $request['status_id'];
        $stage->user_id = $user_id;

        $stage->save();

        return redirect(route('stages.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stage = Stage::findOrFail($id);
        $stage->delete();
        return redirect()->back();
    }
}
