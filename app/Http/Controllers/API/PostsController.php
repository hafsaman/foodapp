<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\Posts;

use App\Models\Posts_Likes;
use App\Models\Posts_Comments;
use App\Models\Postsfavourite;
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
            'region' =>'required',
            'postmedia'=>'required'
        ]);
   	
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $input['title'] = $request->title;
        $input['comment'] = $request->comment;
        $input['is_shopping'] ='yes';
        $input['price'] = $request->price;
        $input['region']=$request->region;
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

    public function getpostsall(){

       
            $posts=Posts::get();
          $success[] = [
            
            'posts'=>$posts,
            'status'=>200,
          ];
            return $this->sendResponse($success, 'Get All Posts Successfully.');
        

    }

    public function getposts(){

      $id= Auth::user()->id;
      if(isset($id)){
            $posts=Posts::where('user_id',$id)->get();
          $success[] = [
            
            'posts'=>$posts,
            'status'=>200,
          ];
            return $this->sendResponse($success, 'Get  Posts Successfully.');
            } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
        

    }

    public function likepost($id){

  //validator place

       $posts = Posts::find($id);
 
        if(isset($posts)){
        	$input['post_id'] = $posts->id;
   		 	$input['user_id'] = Auth::user()->id;
   		 	$input['like'] = 1;
            Posts_Likes::create($input);
          $success[] = [
            
            'status'=>200,
          ];
            return $this->sendResponse($success, 'Post Like successfully.');
        } 
        else{ 
            return $this->sendError('Post Not Exists', ['error'=>'Post Not Found']);
        } 

    }
    public function unlikepost($id){

 
       $posts = Posts::find($id);
 
        if(isset($posts)){
          $input['post_id'] = $posts->id;
        $input['user_id'] = Auth::user()->id;
        $input['like'] = 0;
            Posts_Likes::create($input);
          $success[] = [
            
            'status'=>200,
          ];
            return $this->sendResponse($success, 'Post Like successfully.');
        } 
        else{ 
            return $this->sendError('Post Not Exists', ['error'=>'Post Not Found']);
        } 

    }

    public function favouritepost($id){

 
       $posts = Posts::find($id);
 
        if(isset($posts)){
          $input['post_id'] = $posts->id;
        $input['user_id'] = Auth::user()->id;
        
            Postsfavourite::create($input);
          $success[] = [
            
            'status'=>200,
          ];
            return $this->sendResponse($success, 'Post Favourite successfully.');
        } 
        else{ 
            return $this->sendError('Post Not Exists', ['error'=>'Post Not Found']);
        } 

    }

     public function unfavouritepost($id){

 
       $posts = Posts::find($id);
 
        if(isset($posts)){
       
       // $favourite=Postsfavourite::find($posts->id);
         //$favourite->delete()
          $user_id=Auth::user()->id;
         Postsfavourite::where('user_id', $user_id)
                            ->where('post_id', $posts->id)
                            ->delete();
        $success[] = [
            
            'status'=>200,
          ];
            return $this->sendResponse($success, 'Post Added to UnFavourite successfully.');
        } 
        else{ 
            return $this->sendError('Post Not Exists', ['error'=>'Post Not Found']);
        } 

    }

     public function commentpost(Request $request){

  //validator place
      
       $posts = Posts::find($request->postid);
 
        if(isset($posts)){
        	$input['post_id'] = $posts->id;
        	$input['comment'] = $request->comment;
   		 	  $input['user_id'] = Auth::user()->id;
          Posts_Comments::create($input);
          $success[] = [
            
            'status'=>200,
          ];
            return $this->sendResponse($success, 'Post Comment Added successfully.');
        } 
        else{ 
            return $this->sendError('Post Not Exists', ['error'=>'Post Not Found']);
        } 

    }


}
