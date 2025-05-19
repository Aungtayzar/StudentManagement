<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Region;
use App\Models\Status;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class RegionsController extends Controller
{
  
    public function index(Request $request)
    {

        $statusfilter = $request->input('statusfilter');
        $namefilter = $request['filtername'];

        $query = Region::query();

        if($statusfilter){
            $query->where('status_id',$statusfilter);
        }

        if($namefilter){
            $query->where('name','like','%'.$namefilter.'%');
        }

        $regions = $query->paginate(5)->appends($request->except('page'));
        $countries = Country::pluck('name','id');
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('regions.index',compact('regions','statuses','countries'));
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
            'country_id'=>'required|exists:countries,id'
        ]);
        
        $user = Auth::user();
        $user_id = $user->id;

        $region = new Region();
        $region->name = $request['name'];
        $region->slug = Str::slug($request['name']);
        $region->country_id = $request['country_id'];
        $region->status_id = $request['status_id'];
        $region->user_id = $user_id;

        $region->save();

        session()->flash("success","New Leave Created");

       

        return redirect(route('regions.index'));
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

        $region = Region::findOrFail($id);
        $region->name = $request['name'];
        $region->slug = Str::slug($request['name']);
        $region->country_id = $request['country_id'];
        $region->status_id = $request['status_id'];
        $region->user_id = $user_id;

        $region->save();
        session()->flash("success","Update Successfully");
        return redirect(route('regions.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $region = Region::findOrFail($id);
        $region->delete();
        session()->flash("info","Delete Successfully");
        return redirect()->back();
    }

    public function bulkdeletes(Request $request){
        try{
            $getselectedids = $request->selectedids;
            Region::whereIn('id',$getselectedids)->delete();
            return Response::json(["success"=>"Selected data have been deleted successfully."]);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"Failed.","message"=>$e->getMessage()]);
        }
    }
}
