<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Gender;
use App\Models\Relative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactsController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        $genders = Gender::pluck('name','id');
        $relatives = Relative::pluck('name','id')->prepend("Choose Relative","");
        return view('contacts.index',compact('contacts','relatives','genders'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'firstname'=>'required|min:3|max:50',
            'lastname'=>'max:50',
            'gender_id'=>'nullable|exists:genders,id',
            'birthday'=>'nullable|date|before:today',
            'relative_id'=>'nullable|exists:relatives,id',
            'gender_id'=>'nullable',
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $contact = new Contact();
        $contact->firstname = $request['firstname'];
        $contact->lastname =$request['lastname'];
        $contact->gender_id = $request['gender_id'];
        $contact->birthday = $request['birthday'];
        $contact->relative_id = $request['relative_id'];
        $contact->gender_id = $request['gender_id'];
        $contact->user_id = $user_id;


        $contact->save();

        session()->flash("success","New Contact Created");

        return redirect(route('contacts.index'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $this->validate($request,[
            'editfirstname'=>'required|string|min:3|max:50',
            'editlastname'=>'string|nullable|max:50',
            'editgender_id'=>'nullable|exists:genders,id',
            'editbirthday'=>'nullable|date|before:today',
            'editrelative_id'=>'nullable|exists:relatives,id',
        ]);


        $user = Auth::user();
        $user_id = $user->id;

        $contact = Contact::findOrFail($id);
        $contact->firstname = $request['editfirstname'];
        $contact->lastname =$request['editlastname'];
        $contact->gender_id = $request['editgender_id'];
        $contact->birthday = $request['editbirthday'];
        $contact->relative_id = $request['editrelative_id'];
        $contact->user_id = $user_id;


        $contact->save();

        session()->flash("success","Update Successfully");

        

        return redirect(route('contacts.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::findOrFail($id);

         $contact->delete();
         session()->flash("info","Delete Successfully");
         return redirect()->back();
    }
}
