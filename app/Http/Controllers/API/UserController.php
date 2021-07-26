<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\UserGallary;
use App\Models\Posts;
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
            $user_posts=Posts::where('user_id',$users->id)->get();
          $success[] = [
            'id'=>$users->id,
            'name'=>$users->name,
            'avatar'=>$users->avatar,
            'about'=>$users->about,
            'photos'=>$user_photos,
            'videos'=>$user_videos,
            'posts'=>$user_posts,
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
        $user=User::where('email',$request->email)->first();
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
}