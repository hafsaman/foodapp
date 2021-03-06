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
use App\Models\Ratings;

//use Illuminate\Support\Facades\Auth;
use Validator;
 use Auth; 


class RatingController extends BaseController
{
    function addrate(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'rate_id' => 'required',
            'rate' => 'required',
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $user=Auth::id();
        $input['user_id'] = $user;
        $input['rate'] = $request->rate;
        $input['rate_id'] = $request->rate_id;
        $input['commment'] = $request->comment;
         
        $rating = Ratings::create($input);
       
      if(isset($rating)){
          return $this->sendResponse($rating, 'Create Rating successfully');
        //return $this->sendResponse($success, 'Posts created successfully.');
        } 
        else{ 
            return $this->sendError('User Not Exists.', ['error'=>'User Not Found']);
        } 

    }

    public function listrate(){
        $user_id=Auth::user()->id;
        
        if(isset($user_id)){
            $rate = Ratings::where('user_id',$user_id)->join('users','users.id','=','ratings.rate_id')->select('users.name','users.email','users.profile_photo_path','ratings.rate')->get();
            return $this->sendResponse($rate, 'Rating get successfully.');
        } 
        else{ 
            return $this->sendError('User Not Exists', ['error'=>'UserNot Found']);
        } 
            
    }
    
    
}

