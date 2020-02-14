<?php

namespace App\Http\Controllers\API;

use App\ApiAgent;
use App\Eventlog;
use App\Http\Controllers\Controller;
use App\Http\Requests\AgentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgentController extends Controller

{


    
    public function storeAgent(Request $request)

    {
       // if $findAgent->isDeleted = '1';
        
       //if($this->is_valid_domain_name($request->get('website'))) {
           // dd('hii')
      // }else{
           //dd('web wrong')
       //}
             $validator = Validator::make($request->all(), [
                'code' => 'required | numeric |digits: 4',
                'name' => 'required',
                'addressI' => 'required',
                'addressII' => 'required',
                'addressIII' => 'required',
                'addressIV' => 'required',
                'postcode' => 'required|size:6',
                'website' =>  'required |regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                'telephone_no' => 'required|regex:/(07)[0-9]{9}/',
                'fax_no' => 'required|regex:/(01)[0-9]{9}/',
                'letter_head' => 'required',
                'logo_header_file' => 'required',
                'blank_lines' => 'required',
                'status' => 'required',
                'type' => 'required',
                'belongs_to' => 'required',
            
             ]);

             if ($validator->fails()) {
           $mag = $validator->messages()->first();
           $statusCode = 300;
          }else{

            
            $allRequest = $request->all();

            $logData = [
                'action' => 'Create',
               // 'code' => $request->get('code'),
                //'description' => $request->get('description'),
                'description'=> 'Agent Created',
                'email'=> NULL

               
                
            ];
            
            //dd($allRequest);
            $ckTable =ApiAgent::where('code',$request->get('code'))->first();

            if (!$ckTable) {
                ApiAgent::create($allRequest);
                Eventlog::create($logData);

                $mag = 'Agent Successfully Created';
                $statusCode = 200;
            }else{
                $mag = 'Agent Already Exist';
                $statusCode = 300;
            }

         

        }

        return response()->json($mag,$statusCode);




    }

    //public function is_valid_domain_name($domain_name)
    //{
    //return (preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $domain_name) //valid chars check
     //       && preg_match("/^.{1,253}$/", $domain_name) //overall length check
     //       && preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $domain_name)   ); //length of each label
    //}

    public function updateAgent(Request $request, $id)
    {

        $getAllInputs = $request->except('code');
        $findAgent = ApiAgent::find($id);

        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'name' => 'required',
            'addressI' => 'required',
            'addressII' => 'required',
            'addressIII' => 'required',
            'addressIV' => 'required',
            'postcode' => 'required|size:6',
            'website' => 'required',
            'telephone_no' => 'required|min:10|numeric',
            'fax_no' => 'required|min:10|numeric',
            'letter_head' => 'required',
            'logo_header_file' => 'required',
            'blank_lines' => 'required',
            'status' => 'required',
            'type' => 'required',
            'belongs_to' => 'required',
        ]);

        if($findAgent) {
            if ($validator->fails()) {
                $mag = $validator->messages()->first();
                $statusCode = 300;
             }else{
     
                 
                 $allRequest = $request->all();
     
                 $logData = [
              
                     'action' => 'Update',
                    // 'code' => $request->get('code'),
                     //'description' => $request->get('description'),
                     'description'=> 'Agent Updated'
     
                 ];
     
                // $allRequest['password'] = bcrypt($request->get('password'));
                 //dd($allRequest);
                 
                $findAgent->update($allRequest);
                Eventlog::create($logData);

                $mag = 'Agent Successfully updated';
                $statusCode = 200;
              
     
             }
        }else{
            $mag = 'Agent Not Exist';
            $statusCode = 300;
        }
        

        return response()->json($mag,$statusCode);




    }


    public function deleteAgent(Request $request, $id)
    {

        $findAgent = ApiAgent::find($id);

        if($findAgent) {
           
            $logData = [
                'action' => 'Delete',
               // 'code' => $findAgent->code,
                //'description' => $findAgent->description,
                'description'=> 'Agent Deleted'
                

            ];

           // $findAgent->delete();
           // Eventlog::create($logData);

          //  $mag = 'Agent Successfully deleted';
          //  $statusCode = 200;

          
          $findAgent->isDeleted = '1';
          $findAgent->save();
          Eventlog::create($logData);

          $mag = 'Agent Successfully deleted';
          $statusCode = 200;
              
                

        }else{
            $mag = 'Agent Not Exist';
            $statusCode = 300;
        }
        

        return response()->json($mag,$statusCode);

    }

    
    
}
