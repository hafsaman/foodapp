<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\UserGallary;
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
          $success[] = [
            'id'=>$users->id,
            'name'=>$users->name,
            'avatar'=>$users->avatar,
            'about'=>$users->about,
            'photos'=>$user_photos,
            'videos'=>$user_videos,
            'status'=>200,
          ];
            return $this->sendResponse($success, 'Get User profile successfully.');
        } 
        else{ 
            return $this->sendError('User Not Exists', ['error'=>'User Not Found']);
        } 

    }

   public function profileedit($id, Request $request){

  

      $users = user::find($id);
       //return response()->json($request->about);
      if(isset($users)){
          $users->name = $request->name;
          $users->about = $request->about;
          //$users->avatar = $request->avatar->store('avatars','public');
          $users->save();

          $success[] = [
            'id'=>$users->id,
            'name'=>$users->name,
           // 'avatar'=>Storage::url($users->avatar),
            'status'=>200,
          ];
        return $this->sendResponse($success, 'User Profile Edit successfully.');
        } 
        else{ 
            return $this->sendError('User Not Exists.', ['error'=>'Userr Not Found']);
        } 
      

    }
}