<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\UserGallary;
use App\Models\Posts;
use App\Models\Posts_Gallary;
use App\Models\User_Follower;
use App\Models\UserLabels;
use App\Models\Labels;
use App\Models\Ratings;
use App\Models\UserNotification;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Support\Facades\Auth;
use DB;
use Validator;
//use Illuminate\Support\Facades\Storage;
   
class UserController extends BaseController
{

  public function androidnotification($title,$description,$device_id,$type){

                  $serverkey = 'AAAA0cjwCmk:APA91bEFAo1kHBoHSDqqRqvrc71YvVwjXF4NrbkV56gHHpeu8pvi0Ec_oVxewIRKnfKP-chY5oJxBV41_Faqk3OWZ8jojxsbvHW12QAgShK9et4gn5OrdYrey8EXrYlwUsqlu1ifH7h3';

                    $url = 'https://fcm.googleapis.com/fcm/send';

                    $fields = array(

                        'to' => $device_id,
                        'data' => array(
                            'title' => $title,
                            'body' => $description
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
                    $result = curl_exec($ch);
                    curl_close($ch);

                    return $result;


    }


    
     public function allrecommendations(Request $request){
          $users  = Auth::user();
          $recommendation=Ratings::where('user_id',$users->id)->orderby('id','DESC')->paginate($request->limit);

          $success['recommendation'] = $recommendation;
          $success['status'] = 200;
          return $this->sendResponse($success, 'Get User Recommendations successfully.');
     }

     public function storeoreditOrBuy(Request $request){

      try{

          $validator = Validator::make($request->all(), [
              'at_the_farm' => 'required',
              'remote_delivery' => 'required',
              'market' => 'required',
              'other' => 'required',
          ]);
   
          if($validator->fails()){
              return $this->sendError('Validation Error.', $validator->errors());       
          }

            $user_id = Auth::id();

            $update_orcreate =  OrBuy::updateOrCreate([

                  'user_id'   => Auth::user()->id,
              ],[
                  'user_id'     => $user_id,
                  'at_the_farm' => $request->get('at_the_farm'),
                  'remote_delivery' => $request->get("remote_delivery"),
                  'market'   => $request->get('market'),
                  'other'       => $request->get('other'),
              ]);

              $update_orcreatedata =  OrBuy::where('user_id',$user_id)->first();

          return $this->sendResponse($update_orcreatedata, 'OrBuy Added Successfully.');

       }catch(Exception $e){
            $result = [
                'error'=> $e->getMessage(). ' Line No '. $e->getLine() . ' In File'. $e->getFile()
            ];
            Log::error($e->getTraceAsString());
            $result['success'] = false;
            
        }
        return $result;


     }


      

    public function getprofile($id = null){

      //validator place
          if($id){
            $id  = $id;
          }else{
            $id  = Auth::id();
          }
       
          $users = user::find($id);
 
        if(isset($users)){
            $user_posts= Posts::where('user_id',$users->id)->get();
            $user_posts_ids = Posts::where('user_id',$users->id)->pluck('id');
            $user_posts_photos = Posts_Gallary::whereIn('post_id',$user_posts_ids)->where('media_type','=','image/jpeg')->take(10)->get();
            $user_posts_videos = Posts_Gallary::whereIn('post_id',$user_posts_ids)->where('media_type','=','video/quicktime')->take(10)->get();
            $user_photos=UserGallary::where('user_id',$users->id)->where('media_type','=','photo')->take(10);
            $user_videos=UserGallary::where('user_id',$users->id)->where('media_type','=','video')->take(10);
            $user_label=Labels::where('user_id',$users->id)->get();
            $user_rating=Ratings::where('user_id',$users->id)->avg('rate');
            $recommendation=Ratings::where('user_id',$users->id)->orderby('id','DESC')->first();
            $shopping = Posts::where('user_id',$users->id)->where('is_shopping','yes')->get();
            $OrBuy =  OrBuy::where('user_id',$user_id)->first();
            $user_posts=Posts::where('user_id',$users->id)->get();
            $success = array();


            $success['user'] = $users;
            $success['photos'] = $user_posts_photos;
            $success['videos'] = $user_posts_videos;
            $success['labels'] = $user_label;
            $success['posts'] = $user_posts;
            $success['ratings'] = $user_rating;
            $success['shopping'] = $shopping;
            $success['recommendation'] = $recommendation;
            $success['orbuy'] = $OrBuy;
            $success['status'] = 200;
            
            return $this->sendResponse($success, 'Get User profile successfully.');
        } 
        else{ 
            return $this->sendError('User Not Exists', ['error'=>'User Not Found']);
        } 

    }

    public function getshoppingposts(Request $request){

       $users = Auth::user();

        if(isset($users)){
     
            $shopping = Posts::where('user_id',$users->id)->where('is_shopping','yes')->paginate($request->limit);
            
            $success[] = [
              'shopping' => $shopping,
              'status'=>200,
            ];
            return $this->sendResponse($success, 'Get User profile successfully.');
        } 
        else{ 
            return $this->sendError('User Not Exists', ['error'=>'User Not Found']);
        } 

    }

     public function getvideos(Request $request){

       $users = Auth::user();

        if(isset($users)){
     
            $user_videos=UserGallary::where('user_id',$users->id)->where('media_type','=','video')->paginate($request->limit);
            
            $success[] = [
              'user_videos' => $user_videos,
              'status'=>200,
            ];
            return $this->sendResponse($success, 'Get User profile successfully.');
        } 
        else{ 
            return $this->sendError('User Not Exists', ['error'=>'User Not Found']);
        } 

    }

    public function getphotos(Request $request){

       $users = Auth::user();

        if(isset($users)){
     
            $user_photos=UserGallary::where('user_id',$users->id)->where('media_type','=','photo')->paginate($request->limit);
            
            $success[] = [
              'user_photos' => $user_photos,
              'status'=>200,
            ];
            return $this->sendResponse($success, 'Get User profile successfully.');
        } 
        else{ 
            return $this->sendError('User Not Exists', ['error'=>'User Not Found']);
        } 

    }

   public function profileedit( Request $request){

      $id=Auth::user()->id;

      $users = user::find($id);
       
      if(isset($users)){

        if($request->name){
          $name = $request->name;
        }else{
           $name = $users->name;
        }

        if($request->password){
          $password = bcrypt($request->password);;
        }else{
           $password = $users->password;
        }

        if($request->phoneno){
          $phoneno = $request->phoneno;
        }else{
           $phoneno = $users->phoneno;
        }

        if($request->region){
          $region = $request->region;
        }else{
           $region = $users->region;
        }

          if($request->has('avatar')) {
            $fileName = time().'.'.$request->avatar->extension();
            $request->avatar->move(public_path('/assets/users/'), $fileName);
            $img_path = 'assets/users/'.$fileName;
            }
         else
            {
              $img_path= $users->avatar;
            }
          $users->name = $name;
          $users->password= $password;
          $users->phoneno=$phoneno;
          $users->region=$region;
          $users->avatar = $img_path;
          $users->save();

          $success[] = [
            'id'=>$users->id,
            'name'=>$users->name,
            'email'=>$users->email,
            'status'=>200,
          ];
        return $this->sendResponse($success, 'User Profile Edit successfully.');
        } 
        else{ 
            return $this->sendError('User Not Exists.', ['error'=>'Userr Not Found']);
        } 
      

    }
     public function profileabout( Request $request){

      $id=Auth::user()->id;

      $users = user::find($id);
       
      if(isset($users)){
           $validator = Validator::make($request->all(), [
            'about' => 'required',
            ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
     
          $users->about = $request->about;
          $users->save();

          $success[] = [
            'data'=>$users,
            'status'=>200,
          ];
        return $this->sendResponse($success, 'User Profile Edit successfully.');
        } 
        else{ 
            return $this->sendError('User Not Exists.', ['error'=>'Userr Not Found']);
        } 
      

    }

    public function follow($id){

  //validator place

       $users = User::find($id);
 
        if(isset($users)){
           $input['follower_id'] = $id;
           $input['user_id'] = Auth::user()->id;
           $input['follow'] = 1;
            User_Follower::create($input);
            $inputnot['user_id']= $users->id;
            $inputnot['description']= Auth::user()->name ." Follow You";
            $inputnot['postlikeby_userid']= Auth::user()->id;
            $inputnot['post_id']= '0';
            $inputnot['status']='unread';
            UserNotification::create($inputnot);

            $userdta = User::find($users->id);

            $title ="Follow";
            $description = Auth::user()->name." Follow  You";
             $type  = array();
             $type['type'] = '1';
                 
            if($userdta->device_type == 'ios'){
                 $this->iosnotification($title,$description,$userdta->devicetoken,$type);
               
            }else{
               $this->androidnotification($title,$description,$userdta->devicetoken,$type);
                
            }
        
          $success[] = [
            
            'status'=>200,
          ];
            return $this->sendResponse($success, 'Follow successfully.');
        } 
        else{ 
            return $this->sendError('User Not Exists', ['error'=>'User Not Found']);
        } 

    }

    public function unfollow($id){

  //validator place

       $users = User::find($id);
 
        if(isset($users)){
         

            $user_id=Auth::user()->id;
         User_Follower::where('user_id', $user_id)
                            ->where('follower_id', $id)
                            ->delete();
          
       
          $success[] = [
            
            'status'=>200,
          ];
            return $this->sendResponse($success, 'UnFollow successfully.');
        } 
        else{ 
            return $this->sendError('User Not Exists', ['error'=>'User Not Found']);
        } 

    }
    public function getfollwer()
    {


      $user_id= Auth::user()->id;
      if(isset($user_id)){

            $user_follower=User_Follower::where('user_id',$user_id)->select('follower_id')->where('follow',1)->get();
            $posts_all=array();
            $user_data=array();
           
            foreach($user_follower as $user)
            {
              $posts=Posts::where('user_id',$user->follower_id)->get();
           }
            return $this->sendResponse($posts, 'UnFollow successfully.');
        } 
        else{ 
            return $this->sendError('User Not Exists', ['error'=>'User Not Found']);
        } 

      
        
    }



    public function follwersdata(Request $request)
    {

      $user_id= Auth::user()->id;
      if(isset($user_id)){

           $followeruser_id  = User_Follower::where('follower_id',$user_id)->where('follow',1)->pluck('user_id');

          if($request->search){

                $user_follower = User::whereIn('id',$followeruser_id)->where(DB::raw('lower(name)'), 'like', '%' . strtolower($request->search) . '%')->with('followdata')->whereHas('followdata', function (Builder $query)                  use ($user_id) {
                                     $query->where('follower_id',$user_id);
                                     })->paginate(10);
                
          }else{
                $user_follower = User::whereIn('id',$followeruser_id)->with('followdata')->whereHas('followdata', function (Builder $query) use ($user_id) {
                                     $query->where('follower_id',$user_id);
                                     })->paginate(10);

          }

          foreach ($user_follower as $user_follow) {
              $is_followchk = User_Follower::where('user_id',$user_id)->where('follower_id',$user_follow->id)->first();
              if($is_followchk){
                  $is_follow = '1';
              }else{
                  $is_follow = '0';
              }
              $user_follow->is_follow = $is_follow;
          }

           
        
            return $this->sendResponse($user_follower, 'Data found successfully.');
        } 
        else{ 
            return $this->sendError('User Not Exists', ['error'=>'User Not Found']);
        } 
        
    }

     public function follwingdata(Request $request)
    {

      $user_id= Auth::user()->id;
      if(isset($user_id)){

           $followinguser_id  = User_Follower::where('user_id',$user_id)->where('follow',1)->pluck('follower_id');

          if($request->search){
                $user_follower = User::whereIn('id',$followinguser_id)->where(DB::raw('lower(name)'), 'like', '%' . strtolower($request->search) . '%')->with('following_data')
                                     ->whereHas('following_data', function (Builder $query) use ($user_id) {
                                     $query->where('user_id',$user_id);
                                     })
                                     ->paginate(10);
          }else{

                $user_follower = User::whereIn('id',$followinguser_id)->with('following_data')
                                     ->whereHas('following_data', function (Builder $query) use ($user_id) {
                                     $query->where('user_id',$user_id);
                                     })
                                     ->paginate(10);

          }

             foreach ($user_follower as $user_follow) {
              $is_followchk = User_Follower::where('follower_id',$user_id)->where('user_id',$user_follow->id)->first();
              if($is_followchk){
                  $is_follow = '1';
              }else{
                  $is_follow = '0';
              }
              $user_follow->is_follow = $is_follow;
          }
            return $this->sendResponse($user_follower, 'Data found  successfully.');
        } 
        else{ 
            return $this->sendError('User Not Exists', ['error'=>'User Not Found']);
        } 
    }



     public function changelanguage(Request $request)
    {

      $validator = Validator::make($request->all(), [
            'language' => 'required',
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $user=Auth::id();
         
        $language_update = User::where('id',$user)->update([
            'language' =>  $request->language,
        ]);
        $user=Auth::user();
      if(isset($language_update)){
          return $this->sendResponse($user, 'Added Language successfully');
        //return $this->sendResponse($success, 'Posts created successfully.');
        } 
        else{ 
            return $this->sendError('User Not Exists.', ['error'=>'User Not Found']);
        } 

        
    }


    

  
}