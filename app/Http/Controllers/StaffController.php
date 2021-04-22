<?php

namespace App\Http\Controllers;
use App\user;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function getCitizens()
    {
        return response()->json(User::all(),200);
    }

    public function getCitizensById($id)
    {
        $citizens = User::find($id);
        if (is_null($citizens)){
            return response()->json(['message'=>'Citizen Not Found'],404);
        }
        return response()->json($citizens::find($id),200);
    }

    public function getCitizenContacts($id)
    { 
        $contacts = auth()->user()->contacts()->find($id);

        if (!$contacts){
            return response()->json([
                'success'=>false,
                'data' => 'Contacts not found'
            ]);
        }
        return response()->json([
            'success'=>true,
            'data' => $contacts->toArray(),
        ],400);
    }

    public function deactivateAccounts($id)
    {
        $citizens = auth()->user()->find($id);
            if (!$citizens){
                return response()->json([
                    'success'=>false,
                    'data'=>'User with id'.$id.'Could not found'
                ],400);
            }

            if ($citizens->delete()){
                return  response([
                    'success'=>true,
                    'message'=>"Citizen Account Deleted Successfully!"
                ]);
            }else{
                return response()->json([
                    'success'=>false,
                    'message'=>'Product Could not deleted'
                ],500);
            }

    }

    public function updateHealthStatus(Request $request,$id)
    {        
            $status = User::find($id);
            if (!$status) {
                return response()->json([
                    'success'=>false,
                    'data' => 'Health Status with id'.$id.'not found',
                ],500);
            }
    
            $updated = $status->fill($request->all())->save();
    
            if ($updated){
                return response()->json([
                    'success' => true,
                    'data' => 'Health Status Updated Successfully!'
                ],200);
            }else{
                return response()->json([
                    'success' => false,
                    'data' => 'Health Status could not be updated'
                ]);
            }
        }


}
