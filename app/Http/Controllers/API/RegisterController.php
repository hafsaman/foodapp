<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\Region;
use Illuminate\Support\Facades\Auth;
use Validator;
   
class RegisterController extends BaseController
{


    public function region()
    {
        $region = Region::get();
 
        if(isset($region)){
           
          $success[] = [
            
            'status'=>200,
            'data'=>$region
          ];
            return $this->sendResponse($success, 'Region get successfully.');
        } 
        else{ 
            return $this->sendError('Region Not Exists', ['error'=>'Region Not Found']);
        } 
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'region'=>'required',
            'device_type'=>'required',
            
            'devicetoken'=>'required'
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $user=User::where('email',$request->email)->first();
        if(isset($user)){
             return $this->sendError('User Invalid.', 'User Already Exists'); 
        }
        else
        {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
   
        return $this->sendResponse($success, 'User register successfully.');
    }
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['name'] =  $user->name;
   
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }
}