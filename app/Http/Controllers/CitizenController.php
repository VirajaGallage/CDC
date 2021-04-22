<?php

namespace App\Http\Controllers;
use App\user;
use App\contacts;
use Illuminate\Http\Request;

class CitizenController extends Controller
{
    public function locationUpdate(Request $request,$id){
        $location = User::find($id);
        if (!$location) {
            return response()->json([
                'success'=>false,
                'data' => 'Location with id'.$id.'not found',
            ],500);
        }

        $updated = $location->fill($request->all())->save();

        if ($updated){
            return response()->json([
                'success' => true,
                'data' => 'Location Updated Successfully!'
            ],200);
        }else{
            return response()->json([
                'success' => false,
                'data' => 'Location could not be updated'
            ]);
        }

       
    }

    public function addContacts(Request $request){
        $this->validate($request,[
            'name'=> 'required',
            'age' => 'required|min:2',
            'affiliation' => 'required',
            'sex' => 'required',
            'mobile_no' => 'required|min:10',
            'address' => 'required',
            'district' => 'required'
        ]);

        $contacts = new Contacts ();
        $contacts->name = $request->name;
        $contacts->age = $request->age;
        $contacts->sex = $request->sex;
        $contacts->mobile_no =$request->mobile_no;
        $contacts->address = $request->address;
        $contacts->district = $request->district;

        if(auth()->user()->Contacts()->save($contacts)){
            return response()->json([
                'success' => true,
                'data' => $contacts->toArray(),
            ],200);

        }else{
            return response()->json([
                'success' => false,
                'data' => 'contact could not found',
            ]);
        }
    }

    public function locationsave()
    {
        $location = new location ();
        $location->latitude_longitude = $request->latitude_longitude;

        if(auth()->user()->location()->save($locationsave)){
            return response()->json([
                'success' => true,
                'data' => $locationsave->toArray(),
            ],200);

        }else{
            return response()->json([
                'success' => false,
                'data' => 'contact could not found',
            ]);
        }


    }


}
