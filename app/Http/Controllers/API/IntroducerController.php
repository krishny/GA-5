<?php

namespace App\Http\Controllers\API;

use App\ApiUser;
use App\Eventlog;
use App\ApiAgent;
use App\ApiIntroducer;
use App\Http\Controllers\Controller;
use App\Http\Requests\IntroducerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IntroducerController extends Controller
{

    

    public function storeIntroducer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'int_id' => 'required | numeric',
            'introducer_ref' => 'required | numeric |digits: 6',
            'contact_name' => 'required',
            'comp_name' => 'required',
            'address' => 'required',
            'phone_no' => 'required|regex:/(07)[0-9]{9}/',
            'fax_no' => 'required|regex:/(01)[0-9]{9}/',
            'email' => 'required|email|unique:tbl_introducer',
            'url' =>  'required |regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
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
                'description'=> 'Introducer Created'
                
            ];
           // $allRequest['int_id'] = bcrypt($request->get('int_id'));
            //dd($allRequest);
            $ckTable =ApiIntroducer::where('int_id',$request->get('int_id'))->first();

           
               

                if(!$ckTable) {
                    ApiIntroducer::create($allRequest);
                    Eventlog::create($logData);
                    $mag = 'Introducer Successfully Created'; 
                    $statusCode = 200;  
                }
                            
               
              else{
                $mag = 'Introducer Already Exist';
                $statusCode = 300;
                 }

        }

        return response()->json($mag,$statusCode);




    }

    public function updateIntroducer(Request $request, $id)
    {

        $getAllInputs = $request->except('int_id');
        $findIntroducer = ApiIntroducer::find($id);

        $validator = Validator::make($request->all(), [
            'introducer_ref' => 'required | numeric |digits: 6',
            'contact_name' => 'required',
            'comp_name' => 'required',
            'address' => 'required',
            'phone_no' => 'required|regex:/(07)[0-9]{9}/',
            'fax_no' => 'required|regex:/(01)[0-9]{9}/',
            'email' => 'required|email',
            'url' =>  'required |regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'status' => 'required',
        ]);

        if($findIntroducer) {
            if ($validator->fails()) {
                $mag = $validator->messages()->first();
                $statusCode = 300;
             }else{
     
                 
                 $allRequest = $request->all();
     
                 $logData = [
                     'action' => 'Update',
                     'email' => $request->get('email'),
                     'description'=> 'Introducer Updated'
                     
     
                 ];
     
                // $allRequest['password'] = bcrypt($request->get('password'));
                 //dd($allRequest);
                 
                $findIntroducer->update($allRequest);
                Eventlog::create($logData);

                $mag = 'Introducer Successfully updated';
                $statusCode = 200;
              
     
             }
        }else{
            $mag = 'Introducer Not Exist';
            $statusCode = 300;
        }
        

        return response()->json($mag,$statusCode);




    }


    public function deleteIntroducer(Request $request, $id)
    {

        $findIntroducer = ApiIntroducer::find($id);

        if($findIntroducer) {
           
            $logData = [
                'action' => 'Delete',
                'email' => $findIntroducer->email,
                'description'=> 'Introducer Deleted'
                

            ];



            $findIntroducer->isDeleted = '1';
            $findIntroducer->save();
            Eventlog::create($logData);

            $mag = 'Introducer Successfully deleted';
            $statusCode = 200;
                

        }else{
            $mag = 'Introducer Not Exist';
            $statusCode = 300;
        }
        

        return response()->json($mag,$statusCode);

    }

    
    
}
