<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Gender;
use App\Models\Lead;
use App\Models\Post;
use App\Models\Stage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadsController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leads = Lead::all();
        // dd($users);
        return view('leads.index',compact('leads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['genders'] = Gender::where('status_id',3)->orderBy('name','asc')->get()->pluck('name','id');
        $data['countries'] = Country::where('status_id',3)->orderBy('name','asc')->get();
        return view('leads.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate($request,[
            'firstname'=>'required|string|max:100',
            'lastname'=>'string|max:100',
            'gender_id'=>'required|exits:genders,id',
            'age'=>'required|integer|min:13|max:45',
            'email'=>'required|string|email|max:100|unique:leads,email',
            'country_id'=>'required|exists:countries,id|max:100',
            'city_id'=>'required|exists:cities,id',
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $lead = new Lead();
        $lead->firstname  = $request['firstname'];
        $lead->lastname = $request['lastname'];
        $lead->gender_id = $request['gender_id'];
        $lead->age = $request['age'];
        $lead->email = $request['email'];
        $lead->country_id = $request['country_id'];
        $lead->city_id = $request['city_id'];
        $lead->user_id = $user_id;

        $lead->save();

        session()->flash("success","New Leave Created");


        return redirect(route('leads.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lead = Lead::findOrFail($id);
        return view('leads.show',["lead"=>$lead]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['lead'] = Lead::findOrFail($id);
        $data['genders'] = Gender::where('status_id',3)->orderBy('name','asc')->get()->pluck('name','id');
        $data['countries'] = Country::where('status_id',3)->orderBy('name','asc')->get();
        $data['cities'] = City::where('status_id',3)->orderBy('name','asc')->get();
        return view('leads.edit',$data);
    }



    public function update(Request $request, string $id)
{

    $request->validate($request,[
            'firstname'=>'required|string|max:100',
            'lastname'=>'string|max:100',
            'gender_id'=>'required|exits:genders,id',
            'age'=>'required|integer|min:13|max:45',
            'email'=>'required|string|email|max:100|unique:leads,email,'.$id,
            'country_id'=>'required|exists:countries,id|max:100',
            'city_id'=>'required|exists:cities,id',
        ]);


    $user = Auth::user();
    $user_id = $user->id;

    $lead = Lead::findOrFail($id);
    $lead->firstname  = $request['firstname'];
    $lead->lastname = $request['lastname'];
    $lead->gender_id = $request['gender_id'];
    $lead->age = $request['age'];
    $lead->email = $request['email'];
    $lead->country_id = $request['country_id'];
    $lead->city_id = $request['city_id'];
    $lead->user_id = $user_id;

    if($lead->isconverted()){
        return redirect()->back()->with('error',"This leave form has already been converted to an authorize stage. Editing is disabled");
    };

    $lead->save();



    session()->flash("success", "Update Successfully");
    return redirect(route('leads.index'));
}


    /**
     * Remove the specified resource from storage.
     */
    public function converttostudent($id){
        $lead = Lead::findOrFail($id);

        $student = Student::create([
            'firstname'=>
        ]);


        session()->flash("success", "Lead Converted to Student Successfully");
        return redirect()->back();
    }

}
