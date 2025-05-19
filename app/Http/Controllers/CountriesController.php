<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Status;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class CountriesController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $statusfilter = $request->input('statusfilter');
        $namefilter = $request['filtername'];

        $query = Country::query();

        if($statusfilter){
            $query->where('status_id',$statusfilter);
        }

        if($namefilter){
            $query->where('name','like','%'.$namefilter.'%');
        }

        $countries = $query->paginate(5)->appends($request->except('page'));
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('countries.index',compact('countries','statuses'));
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
            'status_id'=>'required|in:3,4'
        ]);
        
        $user = Auth::user();
        $user_id = $user->id;

        $country = new Country();
        $country->name = $request['name'];
        $country->slug = Str::slug($request['name']);
        $country->status_id = $request['status_id'];
        $country->user_id = $user_id;

        $country->save();

        session()->flash("success","New Leave Created");

       

        return redirect(route('countries.index'));
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

        $country = Country::findOrFail($id);
        $country->name = $request['name'];
        $country->slug = Str::slug($request['name']);
        $country->status_id = $request['status_id'];
        $country->user_id = $user_id;

        $country->save();
        session()->flash("success","Update Successfully");
        return redirect(route('countries.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $country = Country::findOrFail($id);
        $country->delete();
        session()->flash("info","Delete Successfully");
        return redirect()->back();
    }

    public function bulkdeletes(Request $request){
        try{
            $getselectedids = $request->selectedids;
            Country::whereIn('id',$getselectedids)->delete();
            return Response::json(["success"=>"Selected data have been deleted successfully."]);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"Failed.","message"=>$e->getMessage()]);
        }
    }
}
