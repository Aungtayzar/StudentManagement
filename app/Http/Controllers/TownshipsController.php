<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use App\Models\Status;
use App\Models\Township;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class TownshipsController extends Controller
{
    public function index(Request $request)
    {

        $statusfilter = $request->input('statusfilter');
        $namefilter = $request['filtername'];

        $query = Township::query();

        if($statusfilter){
            $query->where('status_id',$statusfilter);
        }

        if($namefilter){
            $query->where('name','like','%'.$namefilter.'%');
        }

        $townships = $query->paginate(5)->appends($request->except('page'));
        $countries = Country::pluck('name','id');
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('townships.index',compact('townships','statuses','countries'));
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
            'region_id'=>'required|exists:regions,id',
            'country_id'=>'required|exists:countries,id',
            'city_id'=>'required|exists:cities,id'
        ]);
        
        $user = Auth::user();
        $user_id = $user->id;

        $township = new Township();
        $township->name = $request['name'];
        $township->slug = Str::slug($request['name']);
        $township->region_id = $request['region_id'];
        $township->country_id = $request['country_id'];
        $township->city_id = $request['city_id'];
        $township->status_id = $request['status_id'];
        $township->user_id = $user_id;

        $township->save();

        session()->flash("success","New Township Created");

       

        return redirect(route('townships.index'));
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

        $this->validate($request,[
            'editname'=>'required'.$id,
            'editstatus_id'=>'required|in:3,4',
            'editregion_id'=>'required|exists:regions,id',
            'editcountry_id'=>'required|exists:countries,id',
            'editcity_id'=>'required|exists:cities,id'
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $township = Township::findOrFail($id);
        $township->name = $request['editname'];
        $township->slug = Str::slug($request['editname']);
        $township->country_id = $request['editcountry_id'];
        $township->region_id = $request['editregion_id'];
        $township->city_id = $request['editcity_id'];
        $township->status_id = $request['editstatus_id'];
        $township->user_id = $user_id;

        $township->save();
        session()->flash("success","Update Successfully");
        return redirect(route('townships.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $township = Township::findOrFail($id);
        $township->delete();
        session()->flash("info","Delete Successfully");
        return redirect()->back();
    }

    public function bulkdeletes(Request $request){
        try{
            $getselectedids = $request->selectedids;
            Township::whereIn('id',$getselectedids)->delete();
            return Response::json(["success"=>"Selected data have been deleted successfully."]);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"Failed.","message"=>$e->getMessage()]);
        }
    }
}
