<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required_without:phone',
            'phone' => 'required_without:email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
		if($request->email){
			$user_data_based_email = User::where('email',$request->email)->get()->toArray();
			if($user_data_based_email){
				return $this->sendError('Email address already registered',[],409);
			}
		}
		if($request->phone){
			$user_data_based_phone = User::where('phone',$request->phone)->get()->toArray();
			if($user_data_based_phone){
				return $this->sendError('Phone number address already registered',[],409);
			}
		}
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['user_id'] = 'DK-'.uniqid();
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;
   
        return $this->sendResponse($success, 'User register successfully.');
    }
    
    /**
     * profile update api
     *
     * @return \Illuminate\Http\Response
     */
    public function profileUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required_without:phone',
            'phone' => 'required_without:email',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $input = $request->all();
        $user = User::where('user_id','=',$input['user_id'])->get()->toArray();   
        $update_data = [];
        if($user){
			if($request->email != $input['email']){
				$user_data_based_email = User::where('email',$request->email)->get()->toArray();
				if($user_data_based_email){
					return $this->sendError('Email address already registered',[],409);
				}
			}
			if($request->phone != $input['phone']){
				$user_data_based_phone = User::where('phone',$request->phone)->get()->toArray();
				if($user_data_based_phone){
					return $this->sendError('Phone number address already registered',[],409);
				}
			}
			if(isset($input['firstname']))
				$update_data['firstname'] = $input['firstname'];
				
			if(isset($input['lastname']))
				$update_data['lastname'] = $input['lastname'];
				
			if(isset($input['email']))
				$update_data['email'] = $input['email'];
				
			if(isset($input['phone']))
				$update_data['phone'] = $input['phone'];
			
			if(isset($input['plant_code']))
				$update_data['plant_code'] = $input['plant_code'];
			
			if(isset($input['department']))
				$update_data['department'] = $input['department'];
			
			if(isset($input['profile_image']))
				$update_data['profile_image'] = $input['profile_image'];
			
			if(isset($input['file_data']))
				$update_data['file_data'] = $input['file_data'];
			
			if(isset($input['roles']))
				$update_data['roles'] = $input['roles'];
			
			if(isset($input['user_timezone']))
				$update_data['user_timezone'] = $input['user_timezone'];
			
			if(isset($input['dop']))
				$update_data['dop'] = $input['dop'];
			
			if(isset($input['gender']))
				$update_data['gender'] = $input['gender'];
			
			if(isset($input['name']))
				$update_data['name'] = $input['name'];
				
			if(isset($input['user_id']))
				$update_data['user_id'] = $input['user_id'];
				

			$user = DB::table('dreamzco_donkeys.users')->where('user_id','=',$input['user_id'])->update($update_data);
			return $this->sendResponse($input, 'User data updated successfully.');
		}
		else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
   
    }
    
    /**
     * user Verify api
     *
     * @return \Illuminate\Http\Response
     */
    public function userVerify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required_without:phone',
            'phone' => 'required_without:email',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $input = $request->all();
        if($request->email){
			$user = User::where('email',$request->email)->get()->toArray();
		}
		if($request->phone){
			$user = User::where('phone',$request->phone)->get()->toArray();
		}
        $update_data = [];
        if($user){
			
			if(isset($input['email']) && $input['email']){
				$update_data['email_verified_at'] = date("Y-m-d H:i:s");;
				$update_data['email_verified'] = 1;
				$user = DB::table('dreamzco_donkeys.users')->where('email','=',$input['email'])->update($update_data);
			}
				
			if(isset($input['phone']) && $input['phone']){
				$update_data['phone_verified_at'] = date("Y-m-d H:i:s");
				$update_data['phone_verified'] = 1;
				$user = DB::table('dreamzco_donkeys.users')->where('phone','=',$input['phone'])->update($update_data);
			}
			return $this->sendResponse($input, 'User data updated successfully.');
		}
		else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
   
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
		$validator = Validator::make($request->all(), [
            'password' => 'required',
            'email' => 'required_without:phone',
            'phone' => 'required_without:email',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        if(isset( $request->email) && (Auth::attempt(['email' => $request->email, 'password' => $request->password]))){ 
            $user = Auth::user(); 
            // log::info('user details',[$user]);
            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
            $success['name'] =  $user->name;
            $user->last_login = date("Y-m-d H:i:s");
			$user->save();
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else if(isset( $request->phone) && (Auth::attempt(['phone' => $request->phone, 'password' => $request->password, 'is_live' => 1]))){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
            $success['name'] =  $user->name;
            $user->last_login = date("Y-m-d H:i:s");
			$user->save();
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }
    
    /**
     * Logout api
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        request()->user()->currentAccessToken()->delete();
		return $this->sendResponse([], 'You have successfully logged out!');
    }
    
    /**
     * User Data api
     *
     * @return \Illuminate\Http\Response
     */
    public function user(Request $request)
    {
        $user = Auth::user(); 
        $success['lastname'] =  $user->lastname;
        $success['firstname'] =  $user->firstname;
        $success['email'] =  $user->email;
        $success['phone'] =  $user->phone;
        $success['phone_code'] =  $user->phone_code;
        $success['plant_code'] =  $user->plant_code;
        $success['department'] =  $user->department;
        $success['profile_image'] =  $user->profile_image;
        $success['file_data'] =  $user->file_data;
        $success['roles'] =  $user->roles;
        $success['email_verified'] =  $user->email_verified;
        $success['email_verified_at'] =  $user->email_verified_at;
        $success['phone_verified'] =  $user->phone_verified;
        $success['phone_verified_at'] =  $user->phone_verified_at;
        $success['user_timezone'] =  $user->user_timezone;
        $success['dop'] =  $user->dop;
        $success['gender'] =  $user->gender;
        $success['user_id'] =  $user->user_id;
        $success['name'] =  $user->name;
        return $this->sendResponse($success, 'User data.');
    }
}
