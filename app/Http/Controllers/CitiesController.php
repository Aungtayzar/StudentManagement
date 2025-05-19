<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Region;
use App\Models\Status;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class CitiesController extends Controller
{
     public function index(Request $request)
    {

        $statusfilter = $request->input('statusfilter');
        $namefilter = $request['filtername'];

        $query = City::query();

        if($statusfilter){
            $query->where('status_id',$statusfilter);
        }

        if($namefilter){
            $query->where('name','like','%'.$namefilter.'%');
        }

        $cities = $query->paginate(5)->appends($request->except('page'));
        $regions = Region::pluck('name','id');
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('cities.index',compact('cities','statuses','regions'));
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
            'status_id'=>'required|in:3,4',
            'region_id'=>'required|exists:regions,id'
        ]);
        
        $user = Auth::user();
        $user_id = $user->id;

        $city = new City();
        $city->name = $request['name'];
        $city->slug = Str::slug($request['name']);
        $city->region_id = $request['region_id'];
        $city->status_id = $request['status_id'];
        $city->user_id = $user_id;

        $city->save();

        session()->flash("success","New Leave Created");

       

        return redirect(route('cities.index'));
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

        $city = City::findOrFail($id);
        $city->name = $request['name'];
        $city->slug = Str::slug($request['name']);
        $city->region_id = $request['region_id'];
        $city->status_id = $request['status_id'];
        $city->user_id = $user_id;

        $city->save();
        session()->flash("success","Update Successfully");
        return redirect(route('cities.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $city = City::findOrFail($id);
        $city->delete();
        session()->flash("info","Delete Successfully");
        return redirect()->back();
    }

    public function bulkdeletes(Request $request){
        try{
            $getselectedids = $request->selectedids;
            City::whereIn('id',$getselectedids)->delete();
            return Response::json(["success"=>"Selected data have been deleted successfully."]);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"Failed.","message"=>$e->getMessage()]);
        }
    }
}
