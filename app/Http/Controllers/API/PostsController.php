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
use App\Models\Labels;
use App\Models\UserLabels;
use App\Models\Ratings;
//use Illuminate\Support\Facades\Auth;
use Validator;
 use Auth; 
 use  DB;

class PostsController extends BaseController
{
  

      public function androidnotification($title,$description,$device_id,$type){

                  $serverkey = 'AAAA0cjwCmk:APA91bEFAo1kHBoHSDqqRqvrc71YvVwjXF4NrbkV56gHHpeu8pvi0Ec_oVxewIRKnfKP-chY5oJxBV41_Faqk3OWZ8jojxsbvHW12QAgShK9et4gn5OrdYrey8EXrYlwUsqlu1ifH7h3';

                    $url = 'https://fcm.googleapis.com/fcm/send';

                    $fields = array(

                        'to' => $device_id,
                        'data' => array(
                            'title' => $title,
                            'body' => $description
                        ),
                         "notification" => array(
                            'title' => $title,
                            'body' => $description,
                            'sound' => "default"
                        )
                       
                    );
                    $headers = array(
                        'Authorization: key=' . $serverkey,
                        'Content-Type: application/json'
                    );
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                    curl_exec($ch);
                    curl_close($ch);


    }

          public function iosnotification($title,$description,$device_id,$type){

                  $serverkey = 'AAAA0cjwCmk:APA91bEFAo1kHBoHSDqqRqvrc71YvVwjXF4NrbkV56gHHpeu8pvi0Ec_oVxewIRKnfKP-chY5oJxBV41_Faqk3OWZ8jojxsbvHW12QAgShK9et4gn5OrdYrey8EXrYlwUsqlu1ifH7h3';

                    $url = 'https://fcm.googleapis.com/fcm/send';

                    $fields = array(

                        'to' => $device_id,
                        'data' => array(
                            'body' => $description
                        ),
                        "notification" => array(
                            'body' => $description,
                            'sound' => "default"
                        )
                    );
                    $headers = array(
                        'Authorization: key=' . $serverkey,
                        'Content-Type: application/json'
                    );
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                    curl_exec($ch);
                    curl_close($ch);


    }

     public function teslike(Request $request){
     
     return $this->iosnotificationtest('fgdvfd','dfgdfv','dsdd','vfd');
    }

    public function iosnotificationtest($title,$description,$device_id,$type){

                  $serverkey = 'AAAA0cjwCmk:APA91bEFAo1kHBoHSDqqRqvrc71YvVwjXF4NrbkV56gHHpeu8pvi0Ec_oVxewIRKnfKP-chY5oJxBV41_Faqk3OWZ8jojxsbvHW12QAgShK9et4gn5OrdYrey8EXrYlwUsqlu1ifH7h3';

                    $url = 'https://fcm.googleapis.com/fcm/send';

                    $fields = array(

                        'to' => "f3-G0EYtlkSdkiR9pCCpuc:APA91bHo_Tho6QFQDUB6LZiLnYGZCD75DOTJx4E0ct9rs5plR3z9wTk_G_KYMkYCL0WJPX84j3AIK8-_OI2lVbG1XyyZz3mnxJchAtjKLBDyJJocFz2v98DuyGG0Ne3vt7-aHwC6u_UH",
                        'data' => array(
                            'title' => $title,
                            'body' => $description
                        ),
                        "notification" => array(
                            'title' => $title,
                            'body' => $description,
                            'sound' => "default"
                        )
                    );
                    $headers = array(
                        'Authorization: key=' . $serverkey,
                        'Content-Type: application/json'
                    );
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                    return curl_exec($ch);
                    curl_close($ch);


    }


  

    function on_offnotifications(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'set_notifications_send' => 'required',
         
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $user_id = Auth::id();
        User::where('id',$user_id)->update([
            'set_notifications_send' => $request->set_notifications_send,
        ]);

         $users = User::find($user_id);

      if(isset($users)){
          return $this->sendResponse($users, 'Notification Set successfully');
        //return $this->sendResponse($success, 'Posts created successfully.');
        } 
        else{ 
            return $this->sendError('User Not Exists.', ['error'=>'User Not Found']);
        } 

    }


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

        if($request->seasonal){
           $input['seasonal'] = $request->seasonal;
        }else{
          $input['seasonal'] = '0';
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

    //////////////////////////////////////
      public function getpostsalltest(Request $request){

       $limit=$request->limit;

         if (auth('api')->check()) { 
                $user = auth('api')->user();
                $user_id= $user->id;
          }

           


          return $user_ids;

      if(isset($user_id)){

        if(isset($request->region) && empty($request->label_id) && empty($request->rating)){

          // Region filter

           $users_ids =  User::where('region',$request->region)->pluck('id');

           $posts = Posts::where('region',$request->region)->whereIn('user_id',$users_ids)->orderby('id','desc')->paginate($limit);

        }elseif(empty($request->region) && isset($request->label_id) && empty($request->rating)){
          
          // Label filter

          $labelcheck =   Lable::where('id',$request->label_id)->first();
          if($labelcheck->user_id == '0'){
            $users_ids =  UserLabels::where('label_id',$request->label_id)->pluck('id');
          }else{
            $users_ids =  Lable::where('id',$request->label_id)->pluck('id');
          }
         
            $posts = Posts::where('user_id',$user_ids)->orderby('id','desc')->paginate($limit);
          
            
           
        }elseif(empty($request->region) && empty($request->label_id) && isset($request->rating)){
          
          // Rating filter

          $user_ids =  User::join('ratings','users.id','=','ratings.user_id')
                        ->select('users.*',DB::raw('avg(ratings.rate) as rating'))
                        ->groupBy('users.id')
                        ->havingRaw('avg(ratings.rate) = '.$request->rating)
                        ->pluck('id');

          $user_rating = Ratings::where('user_id',$user_id)->avg('rate');
       
          $posts = Posts::whereIn('user_id',$user_ids)->orderby('id','desc')->paginate($limit);
          
        }elseif(isset($request->region) && isset($request->label_id) && empty($request->rating)){

          // region  label filter
          $labelcheck =   Lable::where('id',$request->label_id)->first();
          if($labelcheck->user_id == '0'){
            $checklabelexists =  UserLabels::where('label_id',$request->label_id)->where('user_id',$user_id)->first();
          }else{
            $checklabelexists =  Lable::where('id',$request->label_id)->where('user_id',$user_id)->first();
          }
          if($checklabelexists){

            $posts = Posts::where('region',$request->region)->where('user_id',$user_id)->orderby('id','desc')->paginate($limit);
          }
          
        }elseif(isset($request->region) && empty($request->label_id) && isset($request->rating)){

          // region  rating filter
         $user_ids =  User::join('ratings','users.id','=','ratings.user_id')
                        ->select('users.*',DB::raw('avg(ratings.rate) as rating'))
                        ->groupBy('users.id')
                        ->havingRaw('avg(ratings.rate) = '.$request->rating)
                        ->pluck('id');

          $user_rating = Ratings::where('user_id',$user_ids)->avg('rate');

          if($request->rating == $user_rating){

               $posts = Posts::where('region',$request->region)->whereIn('user_id',$user_ids)->orderby('id','desc')->paginate($limit);
          }
          
        }elseif(empty($request->region) && isset($request->label_id) && isset($request->rating)){

            // region  label filter

          $labelcheck =   Lable::where('id',$request->label_id)->first();
          if($labelcheck->user_id == '0'){
            $checklabelexists =  UserLabels::where('label_id',$request->label_id)->where('user_id',$user_id)->first();
          }else{
            $checklabelexists =  Lable::where('id',$request->label_id)->where('user_id',$user_id)->first();
          }
          if($checklabelexists){

            $user_rating = Ratings::where('user_id',$user_id)->avg('rate');

            if($request->rating == $user_rating){

                 $posts = Posts::where('user_id',$user_id)->orderby('id','desc')->paginate($limit);
            }

          }
          
        }elseif(isset($request->region) && isset($request->label_id) && isset($request->rating)){

          $labelcheck =   Lable::where('id',$request->label_id)->first();

          if($labelcheck->user_id == '0'){

            $checklabelexists =  UserLabels::where('label_id',$request->label_id)->where('user_id',$user_id)->first();

          }else{

            $checklabelexists =  Lable::where('id',$request->label_id)->where('user_id',$user_id)->first();

          }
          if($checklabelexists){

            $user_rating = Ratings::where('user_id',$user_id)->avg('rate');

            if($request->rating == $user_rating){

                $posts = Posts::where('user_id',$user_id)->orderby('id','desc')->paginate($limit);
            }

            }
          
          }else{

            $posts=Posts::orderby('id','desc')->paginate($limit);

          }
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
    //////////////////////////////////////

    public function getpostsall(Request $request){

       $limit=$request->limit;

         if (auth('api')->check()) { 
                $user = auth('api')->user();
                $user_id= $user->id;
          }

      if(isset($user_id)){

        /*if(isset($request->region) && empty($request->label_id) && empty($request->rating)){

          // Region filter

           $users_ids =  User::where('region',$request->region)->pluck('id');

           $posts = Posts::where('region',$request->region)->whereIn('user_id',$users_ids)->orderby('id','desc')->paginate($limit);

        }elseif(empty($request->region) && isset($request->label_id) && empty($request->rating)){
          
          // Label filter

          $labelcheck =   Lable::where('id',$request->label_id)->first();
          if($labelcheck->user_id == '0'){
            $users_ids =  UserLabels::where('label_id',$request->label_id)->pluck('id');
          }else{
            $users_ids =  Lable::where('id',$request->label_id)->pluck('id');
          }
         
            $posts = Posts::where('user_id',$user_ids)->orderby('id','desc')->paginate($limit);
          
            
           
        }elseif(empty($request->region) && empty($request->label_id) && isset($request->rating)){
          
          // Rating filter

          $user_rating = Ratings::where('user_id',$user_id)->avg('rate');
          User::

          if($request->rating == $user_rating){

              $posts = Posts::where('user_id',$user_id)->orderby('id','desc')->paginate($limit);
          }

        }elseif(isset($request->region) && isset($request->label_id) && empty($request->rating)){

          // region  label filter
          $labelcheck =   Lable::where('id',$request->label_id)->first();
          if($labelcheck->user_id == '0'){
            $checklabelexists =  UserLabels::where('label_id',$request->label_id)->where('user_id',$user_id)->first();
          }else{
            $checklabelexists =  Lable::where('id',$request->label_id)->where('user_id',$user_id)->first();
          }
          if($checklabelexists){

            $posts = Posts::where('region',$request->region)->where('user_id',$user_id)->orderby('id','desc')->paginate($limit);
          }
          
        }elseif(isset($request->region) && empty($request->label_id) && isset($request->rating)){

          // region  rating filter
         $user_ids =  User::with('ratings')
          ->join('ratings','user.id','=','ratings.user_id')
          ->select('user.*',DB::raw('avg(ratings.rate) as rating'))
          ->where('rating',$request->rating)
          ->get();
          

          $user_rating = Ratings::where('user_id',$user_id)->avg('rate');

          if($request->rating == $user_rating){

               $posts = Posts::where('region',$request->region)->where('user_id',$user_id)->orderby('id','desc')->paginate($limit);
          }
          
        }elseif(empty($request->region) && isset($request->label_id) && isset($request->rating)){

            // region  label filter

          $labelcheck =   Lable::where('id',$request->label_id)->first();
          if($labelcheck->user_id == '0'){
            $checklabelexists =  UserLabels::where('label_id',$request->label_id)->where('user_id',$user_id)->first();
          }else{
            $checklabelexists =  Lable::where('id',$request->label_id)->where('user_id',$user_id)->first();
          }
          if($checklabelexists){

            $user_rating = Ratings::where('user_id',$user_id)->avg('rate');

            if($request->rating == $user_rating){

                 $posts = Posts::where('user_id',$user_id)->orderby('id','desc')->paginate($limit);
            }

          }
          
        }elseif(isset($request->region) && isset($request->label_id) && isset($request->rating)){

          $labelcheck =   Lable::where('id',$request->label_id)->first();

          if($labelcheck->user_id == '0'){

            $checklabelexists =  UserLabels::where('label_id',$request->label_id)->where('user_id',$user_id)->first();

          }else{

            $checklabelexists =  Lable::where('id',$request->label_id)->where('user_id',$user_id)->first();

          }
          if($checklabelexists){

            $user_rating = Ratings::where('user_id',$user_id)->avg('rate');

            if($request->rating == $user_rating){

                $posts = Posts::where('user_id',$user_id)->orderby('id','desc')->paginate($limit);
            }

            }
          
          }else{

            $posts=Posts::orderby('id','desc')->paginate($limit);

          }*/
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

    public function  getparticularpost(Request $request){

        $validator = Validator::make($request->all(), [
              'post_id' => 'required',  
          ]);
     
          if($validator->fails()){
              return $this->sendError('Validation Error.', $validator->errors());       
          }
          $user_id= Auth::user()->id;
          $posts = Posts::where('id',$request->post_id)->get();

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

    public function likepost($id){

  //validator place

       $posts = Posts::find($id);
 
            //if(isset($posts)){
            $input['post_id'] = $posts->id;
       		 	$input['user_id'] = Auth::user()->id;
       		 	$input['like'] = 1;
            Posts_Likes::create($input);
            $inputnot['user_id']=$posts->user_id;
            $inputnot['description']= "Liked Your Post";
            $inputnot['postlikeby_userid']= Auth::user()->id;
            $inputnot['post_id']=$posts->id;
            $inputnot['status']='unread';
            UserNotification::create($inputnot);
            $user = User::find($posts->user_id);
            $title ="Like Post";
            $description = Auth::user()->name." Liked Your Post";
            $type = array();
            if($user->device_type == 'ios'){
                 $this->iosnotification($title,$description,$user->devicetoken,$type);
            }else{
                 $this->androidnotification($title,$description,$user->devicetoken,$type);
            }
            
        
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
            $user = User::find($postsdata->user_id);
            $title ="Like Post";
            $description = Auth::user()->name." Commented On Your Post";
            $type = array();
            if($user->device_type == 'ios'){
                  $this->iosnotification($title,$description,$user->devicetoken,$type);
            }else{
                 $this->androidnotification($title,$description,$user->devicetoken,$type);
            }
        
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

            if($request->search){
                $posts =  Posts::where(DB::raw('lower(title)'), 'like', '%' . strtolower($request->search) . '%')->pluck('id');
                $post_favourite =Postsfavourite::where('user_id',$user_id)->whereIn('post_id',$posts)->select('posts_favourite.id','posts_favourite.post_id','posts_favourite.user_id','posts_favourite.created_at')->orderby('id','desc')->paginate($limit);  
            }else{
                $post_favourite =Postsfavourite::where('user_id',$user_id)->select('posts_favourite.id','posts_favourite.post_id','posts_favourite.user_id','posts_favourite.created_at')->orderby('id','desc')->paginate($limit); 
            }

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

    public function getnotification(Request $request){
        $user_id=Auth::user()->id;
        $limit=$request->limit;
        if(isset($user_id)){
            $notification = UserNotification::where('user_id',$user_id)->orderby('id','desc')->paginate($limit);
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
 

   

    public function discover(Request $request){
     $limit=$request->limit;
     if($request->search){
       $posts_likes_data =Posts_likes::select('post_id', DB::raw('count(id) as total_likes'))
            ->where(DB::raw('lower(title)'), 'like', '%' . strtolower($request->search) . '%')
             ->groupBy('post_id')->with('Posts')
             ->orderBy('total_likes')
             ->paginate($limit);

     }else{

        $posts_likes_data =Posts_likes::select('post_id', DB::raw('count(id) as total_likes'))
               ->groupBy('post_id')->with('Posts')
               ->orderBy('total_likes')
               ->paginate($limit);
      }
     
        if($posts_likes_data){
            return $this->sendResponse($posts_likes_data, 'Discover Data found successfully.');
        }
        else{
            return $this->sendResponse('No such data found');
        }
    } 

    public function seasonal(Request $request){
     $limit=$request->limit;
       if($request->search){
          $seasonal_data =Posts::where('seasonal','1')->where(DB::raw('lower(title)'), 'like', '%' . strtolower($request->search) . '%')->paginate($limit);

       }else{

          $seasonal_data =Posts::where('seasonal','1')->paginate($limit);
        }
     
        if($seasonal_data){
            return $this->sendResponse($seasonal_data, 'Seasonl Data found successfully.');
        }
        else{
            return $this->sendResponse('No such data found');
        }
    } 

    public function discover_seasonal_posts(Request $request){
     $limit=$request->limit;

   

     $posts_likes_data =Posts_likes::select('post_id', DB::raw('count(id) as total_likes'))
             ->groupBy('post_id')->with('Posts')
             ->orderBy('total_likes')
             ->paginate($limit);
      $seasonal_data =Posts::where('seasonal','1')->paginate($limit);

      $data = array();
      $data['posts_likes_data'] = $posts_likes_data;
      $data['seasonal_data'] = $seasonal_data;

         return $this->sendResponse($data, 'Data found successfully.');
       
    } 
        

    

}
