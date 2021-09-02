<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\UserGallary;
use App\Models\Posts;
use App\Models\User_Follower;
use App\Models\UserLabels;
use App\Models\Labels;
use App\Models\Ratings;
use App\Models\UserNotification;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Support\Facades\Auth;
use Validator;
//use Illuminate\Support\Facades\Storage;
   
class UserController extends BaseController
{
    
    public function getprofile($id){

  //validator place

       $users = user::find($id);
 
        if(isset($users)){
            $user_photos=UserGallary::where('user_id',$users->id)->where('media_type','=','photo')->get();
            $user_videos=UserGallary::where('user_id',$users->id)->where('media_type','=','video')->get();
            // $user_label=UserLabels::where('user_id',$users->id)->where('media_type','=','video')->get();
            $user_label=UserLabels::join('labels', 'labels.id', '=', 'user_labels.label_id')->where('user_id',$users->id)->get();
            $user_rating=Ratings::where('user_id',$users->id)->avg('rate');
            $user_posts=Posts::where('user_id',$users->id)->get();
          $success[] = [
            'id'=>$users->id,
            'name'=>$users->name,
            'avatar'=>$users->avatar,
            'about'=>$users->about,
            'photos'=>$user_photos,
            'videos'=>$user_videos,
            'posts'=>$user_posts,
            'labels'=>$user_label,
            'ratings'=>$user_rating, 
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
           $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
             'password' => 'required',
            'phoneno' =>'required',
            'region'=>'required',
            'avatar'=>'required'
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $user=User::where('email',$request->email)->where('id','!=',$id)->first();
        if(isset($user)){
             return $this->sendError('User Invalid.', 'User Already Exists'); 
        }
          if($request->has('avatar')) {
            $fileName = time().'.'.$request->avatar->extension();
            $request->avatar->move(public_path('/assets/users/'), $fileName);
            $img_path = 'assets/users/'.$fileName;
            }
         else
            {$img_path='';}
          $users->name = $request->name;
          $users->email = $request->email;
          $users->password=bcrypt( $request->password);
          $users->phoneno=$request->phoneno;
          $users->region=$request->region;
          $users->avatar = $request->img_path;
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
            'id'=>$users->id,
            'name'=>$users->name,
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
                                     $query->where('user_id',$user_id);
                                     })->paginate(10);

                
          }else{

                $user_follower = User::whereIn('id',$followeruser_id)->with('followdata')->whereHas('followdata', function (Builder $query) use ($user_id) {
                                     $query->where('user_id',$user_id);
                                     })->paginate(10);

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

           
        
            return $this->sendResponse($user_follower, 'Data found  successfully.');
        } 
        else{ 
            return $this->sendError('User Not Exists', ['error'=>'User Not Found']);
        } 

      
        
    }

  
}