<?php

namespace App\Http\Controllers\API;

use App\ApiUser;
use App\Eventlog;
use App\ApiAgent;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function getUser($id) {
        $findUser = ApiUser::find($id);
        return $findUser->agent->code;
    }

    public function storeUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'sur_name' => 'required',
            'email' => 'required|email|unique:tbl_users',
            //'email'=> 'required|email|unique:tbl_users,email',
            'login_name' => 'required',
            'password' => 'required | regex:/^.*(?=.{3,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#@%])/',
            //'password' => ['required', 
            //'min:6', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/'],
            'operatorLevel' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
           $mag = $validator->messages()->first();
           $statusCode = 300;
        }else{

            
            $allRequest = $request->all();

            $logData = [
                'action' => 'Create',
                'email' => $request->get('email'),
                'description'=> 'User Created'
                
            ];
            $allRequest['password'] = bcrypt($request->get('password'));
            //dd($allRequest);
            $ckTable =ApiUser::where('email',$request->get('email'))->first();

            if (!$ckTable) {
                $findAgent = ApiAgent::find($request->get('agent_id'));
               

                if($findAgent) {
                    ApiUser::create($allRequest);
                    Eventlog::create($logData);
                    $mag = 'User Successfully Created'; 
                    $statusCode = 200;  
                }else{
                    $mag = 'Agent Not Found';
                    $statusCode = 300;
                }
                // if(isset($ckTable->agent) && $ckTable->agent->id == $request->get('agent_id')) {
                //     $ckTable->agent_id = $request->get('agent_id');
                //     $ckTable->save(); 
                //     $mag = 'User Successfully Created'; 
                //     $statusCode = 200;      
                // }else {
                //     $mag = 'Agent Not Found & User Created';
                //     $statusCode = 300;
                // }

                
               
            }else{
                $mag = 'User Already Exist';
                $statusCode = 300;
            }

        }

        return response()->json($mag,$statusCode);




    }

    public function updateUser(Request $request, $id)
    {

        $getAllInputs = $request->except('password');
        $findUser = ApiUser::find($id);

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'sur_name' => 'required',
            'agent_id' => 'required',
            'email' => 'required|email',
            'login_name' => 'required',
        
            'operatorLevel' => 'required',
            'status' => 'required',
        ]);

        if($findUser) {
            if ($validator->fails()) {
                $mag = $validator->messages()->first();
                $statusCode = 300;
             }else{
     
                 
                 $allRequest = $request->all();
     
                 $logData = [
                     'action' => 'Update',
                     'email' => $request->get('email'),
                     'description'=> 'User Updated'
                     
     
                 ];
     
                // $allRequest['password'] = bcrypt($request->get('password'));
                 //dd($allRequest);
                 
                $findUser->update($allRequest);
                Eventlog::create($logData);

                $mag = 'User Successfully updated';
                $statusCode = 200;
              
     
             }
        }else{
            $mag = 'User Not Exist';
            $statusCode = 300;
        }
        

        return response()->json($mag,$statusCode);




    }


    public function deleteUser(Request $request, $id)
    {

        $findUser = ApiUser::find($id);

        if($findUser) {
           
            $logData = [
                'action' => 'Delete',
                'email' => $findUser->email,
                'description'=> 'User Deleted'
                

            ];



            $findUser->isDeleted = '1';
            $findUser->save();
            Eventlog::create($logData);

            $mag = 'User Successfully deleted';
            $statusCode = 200;
                

        }else{
            $mag = 'User Not Exist';
            $statusCode = 300;
        }
        

        return response()->json($mag,$statusCode);

    }

    
    
}
