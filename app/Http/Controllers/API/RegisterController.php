<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\Region;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\ForgotPassword;
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
            'devicetoken'=>'required',  

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
        $success['id'] =  $user->id;
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
        if($mainUserchk != ""){
            if($login_type == 'google'){  
                $update = User::where(["google_id" => $request->google_id])->update([
                            'login_type' => $request->login_type,
                            'device_type' => $request->device_type,
                            'devicetoken' => $request->devicetoken,
                            
                         ]);  
                }else{
                    $update = User::where(["apple_id" => $request->apple_id])->update([
                            'login_type' => $request->login_type,
                            'device_type' => $request->device_type,
                            'devicetoken' => $request->devicetoken,
                            
                         ]);
                }
            $success['token'] =  $mainUserchk->createToken('MyApp')->accessToken;
            $success['name'] =  $mainUserchk->name;   
            $success['id'] =  $mainUserchk->id;
            $success['region'] =  ($mainUserchk->region != '') ? $mainUserchk->region : '';    
            return $this->sendResponse($success, 'User Login successfully.');
            
        }else{

            $emailchk_alreadyexist = User::where('email', $request->email)->first();
            if($emailchk_alreadyexist){

            if($login_type == 'google'){  
                $update = User::where(["email" => $request->email])->update([
                            'google_id' => $request->google_id,
                            'login_type' => $request->login_type,
                            'device_type' => $request->device_type,
                            'devicetoken' => $request->devicetoken,
                            
                         ]);  
            }else{
                $update = User::where(["email" => $request->email])->update([
                        'apple_id' => $request->apple_id,
                        'login_type' => $request->login_type,
                        'device_type' => $request->device_type,
                        'devicetoken' => $request->devicetoken,
                        
                     ]);
            }

            $success['token'] =  $emailchk_alreadyexist->createToken('MyApp')->accessToken;
            $success['name'] =  $emailchk_alreadyexist->name; 
            $success['id'] =  $emailchk_alreadyexist->id; 
             $success['region'] =  ($emailchk_alreadyexist->region != '') ? $emailchk_alreadyexist->region : '';  

            return $this->sendResponse($success, 'User Login successfully.');

            }else{


                $input = $request->all();
                $user = User::create($input);
                $success['token'] =  $user->createToken('MyApp')->accessToken;
                $success['name'] =  $user->name;
                $success['id'] =  $user->id;
                $success['region'] =  ($user->region != '') ? $user->region : '';  
           
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
             $update = User::where(["id" => $user->id])->update([
                            'login_type' => 'normal',
                            'device_type' => $request->device_type,
                            'devicetoken' => $request->devicetoken,
                            
                         ]);  
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['name'] =  $user->name;
            $success['role'] =  $user->role;
            $success['id'] =  $user->id;
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }

     public function forgotPassword(Request $request){
        
        $email = $request->email;
        $user = User::where('email', $request->get('email'))->first();
        if($user){
            $otp =  mt_rand(1000,9999);
            $user->otp = $otp;
            $user->save();
            Mail::to($email)->send(new ForgotPassword($user->name,$otp));
            $success['message'] = 'Please check your email for new password';
            return $this->sendResponse($success, 'Please check your email for code to change new password.');
            
        }else{
           return $this->sendError('User Not Found.', ['error'=>'Unauthorised']);
        }
        
        
    }

    public function ChangePassword(Request $request){
        
        $password = $request->password;
        $email = $request->email;
        $user = User::where('email', $request->get('email'))->update([
            'password' => bcrypt($password)
        ]);
        if($user){
            $userdata = User::where('email', $request->get('email'))->first();
            $success['user'] = $userdata;
            return $this->sendResponse($success, 'Password Updated Successfully');
            
        }else{
           return $this->sendError('Something went wrong.', ['error'=>'Something went wrong']);
        }
        
        
    }

      public function VerifyOTP(Request $request){
        
        $otp = $request->otp;
        $user = User::where('otp', $request->get('otp'))->where('email', $request->get('email'))->first();
        if($user){
            $success = 200;
            return $this->sendResponse($success, 'Please check your email for code to change new password.');
            
        }else{
           return $this->sendError('OTP NOT Found.', ['error'=>'Unauthorised']);
        }
        
        
    }
}