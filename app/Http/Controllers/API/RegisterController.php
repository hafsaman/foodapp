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
           
         
            return $this->sendResponse($region, 'Region get successfully.');
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
        $success['region'] =  $user->region;
   
        return $this->sendResponse($success, 'User register successfully.');
    }
    }

     /**
     * Social login api
     *
     * @return \Illuminate\Http\Response
     */
    public function sociallogin(Request $request)
    {

        if($request->google_id){
            $login_id = $request->google_id;
            $login_type = 'google';
            $input['login_type'] = $login_type;
            $input['google_id'] = $request->google_id;
            $mainUserchk = User::where('google_id', $request->google_id)->first();
        }else{
            $login_id = $request->apple_id;
            $input['apple_id'] = $request->apple_id;
            $login_type = 'apple';
             $input['login_type'] = $login_type;
             $mainUserchk = User::where('apple_id', $request->apple_id)->first();
        }

        if($mainUserchk){
            if($login_type == 'google'){  
                $update = User::where(["google_id" => $request->google_id])->update([
                            'login_type' => $login_type,
                            
                         ]);  
                }else{
                    $update = User::where(["apple_id" => $request->apple_id])->update([
                            'login_type' => $login_type,
                            
                         ]);
                }
            $success['token'] =  $mainUserchk->createToken('MyApp')->accessToken;
            $success['name'] =  $mainUserchk->name;   
            $success['region'] =  $mainUserchk->region;     
            return $this->sendResponse($success, 'User Login successfully.');
            
        }else{

            $emailchk_alreadyexist = User::where('email', $request->email)->first();
            if($emailchk_alreadyexist){

            if($login_type == 'google'){  
                $update = User::where(["email" => $request->email])->update([
                            'google_id' => $request->google_id,
                            'login_type' => $login_type,
                            
                         ]);  
            }else{
                $update = User::where(["email" => $request->email])->update([
                        'apple_id' => $request->google_id,
                        'login_type' => $login_type,
                        
                     ]);
            }

            $success['token'] =  $emailchk_alreadyexist->createToken('MyApp')->accessToken;
            $success['name'] =  $emailchk_alreadyexist->name;  
             $success['region'] =  $emailchk_alreadyexist->region;    

            return $this->sendResponse($success, 'User Login successfully.');

            }else{


                $input = $request->all();
                $user = User::create($input);
                $success['token'] =  $user->createToken('MyApp')->accessToken;
                $success['name'] =  $user->name;
                $success['region'] =  $user->region;
           
                return $this->sendResponse($success, 'User register successfully.');


            }
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
            $success['role'] =  $user->role;
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }
}