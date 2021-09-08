<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\Posts;
use App\Models\Posts_Gallary;

use App\Models\Posts_Likes;
use App\Models\Posts_Comments;
use App\Models\Postsfavourite;
use App\Models\UserGallary;
use App\Models\User_Follower;
use App\Models\Labels;
use App\Models\UserLabels;

//use Illuminate\Support\Facades\Auth;
use Validator;
 use Auth; 


class LabelController extends BaseController
{
    function createlabel(Request $request)
    {
     
        if($request->label_id){

              $labeldata =   new UserLabels;
              $labeldata->user_id = Auth::id();
              $labeldata->label_id = $request->label_id;
              $labeldata->save();

              return $this->sendResponse($labeldata, 'Create Label successfully');

        }else{

             $validator = Validator::make($request->all(), [
                'name' => 'required',
                'image' => 'required',
                ]);
            
                if($validator->fails()){
                    return $this->sendError('Validation Error.', $validator->errors());       
                }

            $input['name'] = $request->name;
            $input['user_id'] = Auth::id();
             
            if($request->has('image')) {
                $input_file = $request->image->getClientOriginalName();
                $file_name = pathinfo($input_file, PATHINFO_FILENAME);
                $fileName = $file_name.time().'.'.$request->image->getClientOriginalExtension();
                $request->image->move(public_path('/assets/label/'), $fileName);
                $img_path = 'assets/label/'.$fileName;
                          
            }
            $input['image'] = $img_path;
            $label = Labels::create($input);

        }

      if(isset($label)){
          return $this->sendResponse($label, 'Create Label successfully');
        //return $this->sendResponse($success, 'Posts created successfully.');
        } 
        else{ 
            return $this->sendError('User Not Exists.', ['error'=>'User Not Found']);
        } 

    }

    function editlabel(Request $request)
    {
        $labels=Labels::find($request->label_id);
        if($request->has('name')){
            $input['name'] = $request->name;
        }
        else{
            $input['name']=$labels->name;
        }

        if($request->has('image')) {
                 $input_file = $request->image->getClientOriginalName();

            $file_name = pathinfo($input_file, PATHINFO_FILENAME);
            $fileName = $file_name.time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/assets/label/'), $fileName);
            $img_path = 'assets/label/'.$fileName;
            $input['image'] = $img_path;
        }
        else{
            $input['image']=$labels->image;
        }
        $label = Labels::where('id',$request->label_id)->update($input);

      if(isset($label)){
          return $this->sendResponse($label, 'Edit Label successfully');
        //return $this->sendResponse($success, 'Posts created successfully.');
        } 
        else{ 
            return $this->sendError('User Not Exists.', ['error'=>'User Not Found']);
        } 

    }

    public function deletelabel($id)
    {
        $label=Labels::find($id);
        $user_id = Auth::id();
        if(isset($label)){
            if($label->user_id == '0'){
                UserLabels::where('label_id',$id)->where('user_id',$user_id)->delete();
            }else{
                Labels::where('id',$id)->delete();
            }
            
            return $this->sendResponse($label, 'Label deleted successfully.');
        } 
        else{ 
            return $this->sendError('Label Not Exists', ['error'=>'Label Not Found']);
        } 
    }

    public function getlabel()
    {
        $label = Labels::get();
 
        if(isset($label)){
           
         
            return $this->sendResponse($label, 'Label get successfully.');
        } 
        else{ 
            return $this->sendError('Label Not Exists', ['error'=>'Label Not Found']);
        } 
    }

    function edituserlabel(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'label_id' => 'required',
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $user_id=Auth::id();
        $input['user_id'] = $user_id;
        $input['label_id']= $request->label_id;
         
        $user_label = UserLabels::create($input);
       
         

      if(isset($user_label)){
          return $this->sendResponse($user_label, 'Create User Label successfully');
        //return $this->sendResponse($success, 'Posts created successfully.');
        } 
        else{ 
            return $this->sendError('User Not Exists.', ['error'=>'User Not Found']);
        } 

    }

}

