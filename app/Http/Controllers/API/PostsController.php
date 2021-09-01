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
use App\Models\UserNotification;
//use Illuminate\Support\Facades\Auth;
use Validator;
 use Auth; 

class PostsController extends BaseController
{
  

    function createpost(Request $request)
    {
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
        $input['is_shopping'] =$request->shopping;
        $input['price'] = $request->price;
        $input['region']=$request->region;
        $input['user_id'] = Auth::user()->id;
        $posts = Posts::create($input);
        
       /* if($request->has('postmedia')) {
           return response()->json(count($request->postmedia), 200);
           /* $fileName = time().'.'.$request->postmedia->extension();
            $request->postmedia->move(public_path('/assets/posts/'), $fileName);
            $img_path = 'assets/posts/'.$fileName;
           
          
        } */
        if($request->has('postmedia')) {
            foreach($request->file('postmedia') as $mediaFiles) {
                 $input_file = $mediaFiles->getClientOriginalName();

            $file_name = pathinfo($input_file, PATHINFO_FILENAME);
            $fileName = $file_name.time().'.'.$mediaFiles->getClientOriginalExtension();
            $mediaFiles->move(public_path('/assets/posts/'), $fileName);
            $img_path = 'assets/posts/'.$fileName;
            $data['post_id']=$posts->id;
            $data['media_path']=$img_path;
            $mediatype=mime_content_type($img_path);//$mediaFiles->getMimeType();
            $data['media_type']=$mediatype;
            Posts_Gallary::create($data);

          }
        }
         
    
        

      if(isset($posts)){
          return $this->sendResponse($posts, 'Create Post successfully');
        //return $this->sendResponse($success, 'Posts created successfully.');
        } 
        else{ 
            return $this->sendError('User Not Exists.', ['error'=>'User Not Found']);
        } 

    }

    public function getpostsall(Request $request){

       $limit=$request->limit;

       if (auth('api')->check()) { 
    $user = auth('api')->user();
    $user_id= $user->id;
}
       
  
          
      if(isset($user_id)){

            $posts=Posts::orderby('id','desc')->paginate($limit);
          
            $posts_all=array();
            $user_data=array();
            
            foreach($posts as $post)
            {
              $post_media=Posts_Gallary::where('post_id',$post->id)->select('media_path','media_type')->get();
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


            $comments=Posts_Comments::where('post_id',$post->id)->join('users','users.id','=','posts_comments.user_id')->select('posts_comments.id','posts_comments.post_id','posts_comments.user_id','posts_comments.comment','posts_comments.created_at','users.name','users.email','users.avatar')->get();
            $user_follower=User_Follower::where('follower_id',$user_id)->where('user_id',$post->user_id)->select('id')->first();
            if(isset($user_follower)){ $is_follow=1; }
            else{ $is_follow=0;}

            $user=User::where('id',$post->user_id)->first();

             $user_data=array("id"=>$user->id,"name"=>$user->name,"email"=>$user->email,"avatar"=>$user->avatar,'is_follow'=>$is_follow);
         
              $comment_data=array("post_id"=>$post->id,"user_id"=>$user->id,"comment"=>$post->comment,"created_at"=>$post->created_at,"name"=>$user->name,"email"=>$user->email,"avatar"=>$user->avatar);
               // $media_path=explode(",",$post->media_path);
             //   $post->media_path=$media_path;
              $post->comment=$comment_data;
              $post->no_of_like = $nooflike;
              $post->no_of_favourite = $nooffavourite;
              $post->is_like = $is_like;
              $post->is_favourite = $is_favourite;
              $post->comments = $comments;
              $post->user_data = $user_data;
              $post->media_path=$post_media;
             // $item['product'] = $product;
            $posts_all[] = array("id"=>$post->id,"title"=>$post->title,"comment"=>$post->comment,"is_shopping"=>$post->is_shopping,'price'=>$post->price,'region'=>$post->region,'user_id'=>$post->user_id,'media_path'=>$post->media_path,'created_at'=>$post->created_at,'no_of_like'=>$nooflike,'no_of_favourite'=>$nooffavourite,'is_like'=>null,'is_favourite'=>null,'comments'=>$comments,'user_data'=>$user_data);
     

            }
                   

            return $this->sendResponse($posts, 'Get All Posts Successfully.');
          }
          else {
         $posts=Posts::orderby('id','desc')->paginate($limit);
          
            $posts_all=array();
            $user_data=array();
            
            foreach($posts as $post)
            {
              $post_media=Posts_Gallary::where('post_id',$post->id)->select('media_path','media_type')->get();
              $postlike=Posts_Likes::where('post_id',$post->id)->selectRaw('count(id) as totallike')->first();
              $nooflike=$postlike->totallike;
              $postfavourite=Postsfavourite::where('post_id',$post->id)->selectRaw('count(id) as totalfavourite')->first();
              $nooffavourite=$postfavourite->totalfavourite;
           

            $comments=Posts_Comments::where('post_id',$post->id)->join('users','users.id','=','posts_comments.user_id')->select('posts_comments.id','posts_comments.post_id','posts_comments.user_id','posts_comments.comment','posts_comments.created_at','users.name','users.email','users.avatar')->get();

            $user=User::where('id',$post->user_id)->first();

            
              $user_data=array("id"=>$user->id,"name"=>$user->name,"email"=>$user->email,"avatar"=>$user->avatar,'is_follow'=>null);
             $comment_data=array("post_id"=>$post->id,"user_id"=>$user->id,"comment"=>$post->comment,"created_at"=>$post->created_at,"name"=>$user->name,"email"=>$user->email,"avatar"=>$user->avatar);
               // $media_path=explode(",",$post->media_path);
             //   $post->media_path=$media_path;
              $post->comment=$comment_data;
              $post->no_of_like = $nooflike;
              $post->no_of_favourite = $nooffavourite;
              $post->is_like = null;
              $post->is_favourite = null;
              $post->comments = $comments;
              $post->user_data = $user_data;
              $post->media_path=$post_media;
             // $item['product'] = $product;
            $posts_all[] = array("id"=>$post->id,"title"=>$post->title,"comment"=>$post->comment,"is_shopping"=>$post->is_shopping,'price'=>$post->price,'region'=>$post->region,'user_id'=>$post->user_id,'media_path'=>$post->media_path,'created_at'=>$post->created_at,'no_of_like'=>$nooflike,'no_of_favourite'=>$nooffavourite,'is_like'=>null,'is_favourite'=>null,'comments'=>$comments,'user_data'=>$user_data);
     

            }
                   

            return $this->sendResponse($posts, 'Get All Posts Successfully.');
          }

    }

     public function getposts(Request $request){

      $user_id= Auth::user()->id;
       $limit=$request->limit;
       //$posts=Posts::paginate($limit);
         
      if(isset($user_id)){

            $user_follower=User_Follower::where('user_id',$user_id)->where('follow',1)->distinct()->pluck('follower_id')->toarray();
              $posts_all=array();
            $user_data=array();
                 $posts=Posts::whereIn('user_id',$user_follower)->orderby('id','desc')->paginate($limit);   
            foreach($posts as $post)
            {
              $post_media=Posts_Gallary::where('post_id',$post->id)->select('media_path','media_type')->get();
           
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

            $comments=Posts_Comments::where('post_id',$post->id)->join('users','users.id','=','posts_comments.user_id')->select('posts_comments.id','posts_comments.post_id','posts_comments.user_id','posts_comments.comment','posts_comments.created_at','users.name','users.email','users.avatar')->get();

           
            $user=User::where('id',$post->user_id)->first();

             $user_data=array("id"=>$user->id,"name"=>$user->name,"email"=>$user->email,"avatar"=>$user->avatar,'is_follow'=>1);
            $comment_data=array("post_id"=>$post->id,"user_id"=>$user->id,"comment"=>$post->comment,"created_at"=>$post->created_at,"name"=>$user->name,"email"=>$user->email,"avatar"=>$user->avatar);
               // $media_path=explode(",",$post->media_path);
             //   $post->media_path=$media_path;
              $post->comment=$comment_data;

              $post->no_of_like = $nooflike;
              $post->no_of_favourite = $nooffavourite;
              $post->is_like = $is_like;
              $post->is_favourite = $is_favourite;
              $post->comments = $comments;
              $post->user_data = $user_data;
              $post->media_path=$post_media;
    

            $posts_all[] = array("id"=>$post->id,"title"=>$post->title,"comment"=>$post->comment,"is_shopping"=>$post->is_shopping,'price'=>$post->price,'region'=>$post->region,'user_id'=>$post->user_id,'media_path'=>$post_media,'no_of_like'=>$nooflike,'no_of_favourite'=>$nooffavourite,'is_like'=>$is_like,'is_favourite'=>$is_favourite,'comments'=>$comments,'user_data'=>$user_data);
     

            }
        //  }
                    
            return $this->sendResponse($posts, '');
          }
                else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
        

    }

    public function getuserposts(){

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
 
            //if(isset($posts)){
            $input['post_id'] = $posts->id;
       		 	$input['user_id'] = Auth::user()->id;
       		 	$input['like'] = 1;
            Posts_Likes::create($input);
            $inputnot['user_id']=$posts->user_id;
            $inputnot['description']= Auth::user()->name." Liked Your Post";
            $inputnot['postlikeby_userid']= Auth::user()->id;
            $inputnot['post_id']=$posts->id;
            $inputnot['status']='unread';
            UserNotification::create($inputnot);
        
          $success[] = [
            
            'status'=>200,
          ];
            return $this->sendResponse($success, 'Post Like successfully.');
       // } 
        

    }
    public function unlikepost($id){

 
       $posts = Posts::find($id);
 
        if(isset($posts)){
          $user_id=Auth::user()->id;
         Posts_Likes::where('user_id', $user_id)
                            ->where('post_id', $posts->id)
                            ->delete();
          
           
          $success[] = [
            
            'status'=>200,
          ];
            return $this->sendResponse($success, 'Post unLike successfully.');
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
     // return response()->json($request->postid, 200);
        $posts = Posts::where('id',$request->postid)->pluck('id');
        $postsdata = Posts::where('id',$request->postid)->first();
     
        if(isset($posts)){

        	$input['post_id'] = $request->postid;
        	$input['comment'] = $request->comment;
   		 	  $input['user_id'] = Auth::user()->id;
          $Post_comment=Posts_Comments::create($input);
          $post_comment1 =Posts_Comments::where('posts_comments.id',$Post_comment->id)->join('users','users.id','=','posts_comments.user_id')->select('posts_comments.id','posts_comments.post_id','posts_comments.user_id','posts_comments.comment','posts_comments.created_at','users.name','users.email','users.avatar')->first();
            $inputnot['user_id']=$postsdata->user_id;
            $inputnot['description']= Auth::user()->name." Commented on Your Post";
            $inputnot['postlikeby_userid']= Auth::user()->id;
            $inputnot['post_id']=$request->postid;
            $inputnot['status']='unread';
            UserNotification::create($inputnot);
        
        
            return $this->sendResponse($post_comment1, 'Post Comment Added successfully.');
        } 
        else{ 
            return $this->sendError('Post Not Exists', ['error'=>'Post Comments Not Found']);
        } 

    }


    public function getcomment($postid){

  //validator place
      
       $posts = Posts::find($postid);
 
        if(isset($posts)){
            $post_comment =Posts_Comments::where('post_id',$postid)->join('users','users.id','=','posts_comments.user_id')->select('posts_comments.id','posts_comments.post_id','posts_comments.user_id','posts_comments.comment','posts_comments.created_at','users.name','users.email','users.avatar')->get();
         
            return $this->sendResponse($post_comment, 'Post Comments get successfully.');
        } 
        else{ 
            return $this->sendError('Post Not Exists', ['error'=>'Post  Comments Not Found']);
        } 

    }



     public function getfavourite(Request $request){

  //validator place
       $limit=$request->limit;
    $user_id=Auth::user()->id;
        if(isset($user_id)){
            $post_favourite =Postsfavourite::where('user_id',$user_id)->select('posts_favourite.id','posts_favourite.post_id','posts_favourite.user_id','posts_favourite.created_at')->orderby('id','desc')->paginate($limit);   
         
             foreach($post_favourite as $post)
            {
              $post_media=Posts_Gallary::where('post_id',$post->post_id)->select('media_path','media_type')->get();
           
            $postlike=Posts_Likes::where('post_id',$post->post_id)->selectRaw('count(id) as totallike')->first();
               $nooflike=$postlike->totallike;
            $postfavourite=Postsfavourite::where('post_id',$post->post_id)->selectRaw('count(id) as totalfavourite')->first();
            $nooffavourite=$postfavourite->totalfavourite;
           
            $postuserlike=Posts_Likes::where('post_id',$post->post_id)->where('user_id',$user_id)->selectRaw('count(id) as userlike')->first();
            
            if($postuserlike->userlike != 0){ $is_like=1; }
            else{ $is_like=0;}
            
            $postuserfavourite=Postsfavourite::where('post_id',$post->post_id)->where('user_id',$user_id)->selectRaw('count(id) as userfavourite')->first();
            
            if($postuserfavourite->userfavourite != 0){ $is_favourite=1; }
            else{ $is_favourite=0;}

            $comments=Posts_Comments::where('post_id',$post->post_id)->join('users','users.id','=','posts_comments.user_id')->select('posts_comments.id','posts_comments.post_id','posts_comments.user_id','posts_comments.comment','posts_comments.created_at','users.name','users.email','users.avatar')->get();

           
            $user=User::where('id',$user_id)->first();

             $user_data=array("id"=>$user->id,"name"=>$user->name,"email"=>$user->email,"avatar"=>$user->avatar,'is_follow'=>1);
            $comment_data=array("post_id"=>$post->id,"user_id"=>$user->id,"comment"=>$post->comment,"created_at"=>$post->created_at,"name"=>$user->name,"email"=>$user->email,"avatar"=>$user->avatar);
               // $media_path=explode(",",$post->media_path);
             //   $post->media_path=$media_path;
              $post->comment=$comment_data;

              $post->no_of_like = $nooflike;
              $post->no_of_favourite = $nooffavourite;
              $post->is_like = $is_like;
              $post->is_favourite = $is_favourite;
              $post->comments = $comments;
              $post->user_data = $user_data;
              $post->media_path=$post_media;
    

                       }
        

         /*ends*/
            return $this->sendResponse($post_favourite, 'Post Favourites get successfully.');
        } 
        else{ 
            return $this->sendError('User Not Exists', ['error'=>'UserNot Found']);
        } 

    }

    public function getnotification(){
        $user_id=Auth::user()->id;
        
        if(isset($user_id)){
            $notification = UserNotification::where('user_id',$user_id)->orderby('id','desc')->get();
            return $this->sendResponse($notification, 'Notification get successfully.');
        } 
        else{ 
            return $this->sendError('User Not Exists', ['error'=>'UserNot Found']);
        } 
            
    }

    public function getsearch(Request $request){
        $search=$request->search;
        $user_id=Auth::user()->id;
        if(isset($user_id)){
            $userdata = User::where('name','LIKE',"%{$search}%")->orWhere('email','LIKE',"%{$search}%")->orWhere('region','LIKE',"%{$search}%")->get();
            if($userdata){
                return $this->sendResponse($userdata, 'User found successfully.');
            }
            else{
                return $this->sendResponse('No such users found');
            }
        } 
        else{ 
            return $this->sendError('User Not Exists', ['error'=>'UserNot Found']);
        }
            
    }

}
