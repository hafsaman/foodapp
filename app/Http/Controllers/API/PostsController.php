<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\Posts;
use App\Models\UserGallary;
//use Illuminate\Support\Facades\Auth;
use Validator;
 use Auth; 

class PostsController extends BaseController
{
    public function create(Request $request){

  
    	//return response()->json($request->title);
       $validator = Validator::make($request->all(), [
            'title' => 'required',
         
            'comment' => 'required',
             'shopping' => 'required',
            
        ]);
   	
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $input['title'] = $request->title;
        $input['comment'] = $request->comment;
        
   		 	$input['is_shopping'] ='yes';
        $input['price'] = $request->price;
   		 
        $input['user_id'] = Auth::user()->id;
       
        if($request->has('postmedia')) {
            $fileName = time().'.'.$request->postmedia->extension();
            $request->postmedia->move(public_path('/assets/posts/'), $fileName);
            $img_path = 'assets/posts/'.$fileName;
        }
         else
            {$img_path='';}
         $input['media_path'] = $request->img_path;
        $posts = Posts::create($input);
      if(isset($posts)){
          $success[] = [
            'status'=>200,
          ];
        return $this->sendResponse($success, 'Posts created successfully.');
        } 
        else{ 
            return $this->sendError('User Not Exists.', ['error'=>'User Not Found']);
        } 
      

    }
}
