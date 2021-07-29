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
use App\Models\User_Follower;
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
            $posts_all=array();
            $user_data=array();
            
            foreach($posts as $post)
            {
              $postlike=Posts_Likes::where('post_id',$post->id)->selectRaw('count(id) as totallike')->first();
              $nooflike=$postlike->totallike;
              $postfavourite=Postsfavourite::where('post_id',$post->id)->selectRaw('count(id) as totalfavourite')->first();
              $nooffavourite=$postfavourite->totalfavourite;
           

            $comments=Posts_Comments::where('post_id',$post->id)->get();

            $user=User::where('id',$post->user_id)->first();

            
              $user_data[]=array("id"=>$user->id,"name"=>$user->name,"email"=>$user->email,"avatar"=>$user->avatar);
            


            $posts_all[] = array("id"=>$post->id,"title"=>$post->title,"comment"=>$post->comment,"is_shopping"=>$post->is_shopping,'price'=>$post->price,'region'=>$post->region,'user_id'=>$post->user_id,'media_path'=>$post->media_path,'no_of_like'=>$nooflike,'no_of_favourite'=>$nooffavourite,'comments'=>$comments,'user_data'=>$user_data);
     

            }
                      $success[] = [
            
            'posts'=>$posts_all,
            'status'=>200,
          ];
            return $this->sendResponse($success, 'Get All Posts Successfully.');
        

    }

    public function getposts(){

      $user_id= Auth::user()->id;
      if(isset($user_id)){
           $posts=Posts::where('user_id',$user_id)->get();
            $posts_all=array();
            $user_data=array();
           
            foreach($posts as $post)
            {
              $postlike=Posts_Likes::where('post_id',$post->id)->selectRaw('count(id) as totallike')->first();
               $nooflike=$postlike->totallike;
              $postfavourite=Postsfavourite::where('post_id',$post->id)->selectRaw('count(id) as totalfavourite')->first();
              $nooffavourite=$postfavourite->totalfavourite;
           
            $postuserlike=Posts_Likes::where('post_id',$post->id)->where('user_id',$user_id)->selectRaw('count(id) as userlike')->first();
            if($postuserlike->userlike != 0){ $is_like=1; }
            else{ $is_like=0;}
            
            $postuserfavourite=Postsfavourite::where('post_id',$post->id)->where('user_id',$user_id)->selectRaw('count(id) as userfavourite')->first();
            if($postuserfavourite->userfavourite != 0){ $is_favourite=1; }
            else{ $is_favourite=0;}

            $comments=Posts_Comments::where('post_id',$post->id)->get();

            $user_follower=User_Follower::where('follower_id',$user_id)->where('user_id',$post->user_id)->select('id')->first();
            if(isset($user_follower)){ $is_follow=1; }
            else{ $is_follow=0;}

            $user=User::where('id',$post->user_id)->first();

             $user_data[]=array("id"=>$user->id,"name"=>$user->name,"email"=>$user->email,"avatar"=>$user->avatar,'is_follow'=>$is_follow);


            $posts_all[] = array("id"=>$post->id,"title"=>$post->title,"comment"=>$post->comment,"is_shopping"=>$post->is_shopping,'price'=>$post->price,'region'=>$post->region,'user_id'=>$post->user_id,'media_path'=>$post->media_path,'no_of_like'=>$nooflike,'no_of_favourite'=>$nooffavourite,'is_like'=>$is_like,'is_favourite'=>$is_favourite,'comments'=>$comments,'user_data'=>$user_data);
     

            }
                      $success[] = [
            
            'posts'=>$posts_all,
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
