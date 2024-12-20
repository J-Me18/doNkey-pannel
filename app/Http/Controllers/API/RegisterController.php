<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Driver;
use App\Models\Pincode;
use App\Models\Subscriber;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
// use Dotenv\Validator as DotenvValidator;
// use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

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
            'address1' => 'nullable',
            'address2' => 'nullable',
            'device_token' => 'nullable',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        
        if ($request->email) {
            $user_data_based_email = User::where('email', $request->email)->get()->toArray();
            if ($user_data_based_email) {
                return $this->sendError('Email address already registered', [], 409);
            }
        }
        if ($request->phone) {
            $user_data_based_phone = User::where('phone', $request->phone)->get()->toArray();
            if ($user_data_based_phone) {
                return $this->sendError('Phone number address already registered', [], 409);
            }
        }        
        $input = $request->all();
        $input['otp'] = rand(1000, 9999);
        $input['password'] = bcrypt($input['password']);
        $input['user_id'] = 'DK-' . uniqid();
        $input['is_live'] = 1;
        $user = User::create($input);
        
        if($request->has('address1')){
        UserAddress::create([
        'user_id' => $user->user_id,
        'address1' => $request->input('address1'),
        'type' => '1'
        ]);
        }
        if($request->has('address2')){
        UserAddress::create([
        'user_id' => $user->user_id,
        'address1' => $request->input('address2'),
        'type' => '2'
        ]);
        }
        
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;
        $success['user_id'] =  $user->user_id;
        $success['user_id'] =  $user->user_id;
        $success['id'] =  $user->id;
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
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $input = $request->all();
        $user = User::where('user_id', '=', $input['user_id'])->first();
        $update_data = [];
        if ($user) {

            if ($request->email != $input['email']) {
                $user_data_based_email = User::where('email', $request->email)->get()->toArray();
                if ($user_data_based_email) {
                    return $this->sendError('Email address already registered', [], 409);
                }
            }
            if ($request->phone != $input['phone']) {
                $user_data_based_phone = User::where('phone', $request->phone)->get()->toArray();
                if ($user_data_based_phone) {
                    return $this->sendError('Phone number address already registered', [], 409);
                }
            }
            if (isset($input['firstname']))
                $update_data['firstname'] = $input['firstname'];

            if (isset($input['lastname']))
                $update_data['lastname'] = $input['lastname'];

            if (isset($input['email']))
                $update_data['email'] = $input['email'];

            if (isset($input['phone']))
                $update_data['phone'] = $input['phone'];

            if (isset($input['plant_code']))
                $update_data['plant_code'] = $input['plant_code'];

            if (isset($input['department']))
                $update_data['department'] = $input['department'];

            if (isset($input['profile_image'])) {
                if ($request->hasFile('profile_image')) {

                    $file = $request->file('profile_image');
                    $extension = $file->getClientOriginalExtension();
                    if ($user->profile_image) {
                        Storage::disk('profile')->delete($user->profile_image);
                    }
                    $filename = time() . '.' . $extension;
                    $file->move(storage_path('app/public/profile'), $filename);
                    $input['profile_image'] = $filename;
                }
                $update_data['profile_image'] = $input['profile_image'];
            }


            if (isset($input['file_data']))
                $update_data['file_data'] = $input['file_data'];

            if (isset($input['roles']))
                $update_data['roles'] = $input['roles'];

            if (isset($input['user_timezone']))
                $update_data['user_timezone'] = $input['user_timezone'];

            if (isset($input['dop']))
                $update_data['dop'] = $input['dop'];

            if (isset($input['gender']))
                $update_data['gender'] = $input['gender'];

            if (isset($input['name']))
                $update_data['name'] = $input['name'];

            if (isset($input['user_id']))
                $update_data['user_id'] = $input['user_id'];

            $update_address_data = [];
            DB::table('biketaxi.users')->where('user_id', '=', $input['user_id'])->update($update_data);
            if (isset($input['user_address'])) {
                if (isset($input['user_address']['address1']))
                    $update_address_data['address1'] = $input['user_address']['address1'];

                if (isset($input['user_address']['address2']))
                    $update_address_data['address2'] = $input['user_address']['address2'];

                if (isset($input['user_address']['address3']))
                    $update_address_data['address3'] = $input['user_address']['address3'];

                if (isset($input['user_address']['city']))
                    $update_address_data['city'] = $input['user_address']['city'];

                if (isset($input['user_address']['state']))
                    $update_address_data['state'] = $input['user_address']['state'];

                if (isset($input['user_address']['country']))
                    $update_address_data['country'] = $input['user_address']['country'];

                if (isset($input['postal_code']['postal_code']))
                    $update_address_data['postal_code'] = $input['user_address']['postal_code'];

                if ($update_address_data) {
                    DB::table('biketaxi.user_address')->where('user_id', '=', $input['user_id'])->update($update_address_data);
                }
            }

            return $this->sendResponse($input, 'User data updated successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    /**
     * user Verify api
     *
     * @return \Illuminate\Http\Response
     */
    public function userFilter(Request $request, $action)
    {
        switch ($action) {

            case 'postal_code':
                $validator = Validator::make($request->all(), [
                    'postal_code' => 'required'
                ]);

                if ($validator->fails()) {
                    return $this->sendError('Validation Error.', $validator->errors());
                }

                $input = $request->all();

                $users = DB::table('biketaxi.users as A')->join('biketaxi.user_address as B', 'B.user_id', '=', 'A.user_id')->where('postal_code', $input['postal_code'])->select('B.address1', 'B.address2', 'B.address3', 'B.city', 'B.state', 'B.country', 'B.postal_code', 'A.name', 'A.firstname', 'A.lastname', 'A.email', 'A.phone', 'A.phone_code', 'A.profile_image', 'A.user_id')->get();

                return $this->sendResponse($users, 'User List.');
                break;
        }
    }
    public function userVerify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required_without:phone',
            'phone' => 'required_without:email',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $input = $request->all();
        if ($request->email) {
            $user = User::where('email', $request->email)->get()->toArray();
        }
        if ($request->phone) {
            $user = User::where('phone', $request->phone)->get()->toArray();
        }
        $update_data = [];
        if ($user) {

            if (isset($input['email']) && $input['email']) {
                $update_data['email_verified_at'] = date("Y-m-d H:i:s");;
                $update_data['email_verified'] = 1;
                $user = DB::table('biketaxi.users')->where('email', '=', $input['email'])->update($update_data);
            }

            if (isset($input['phone']) && $input['phone']) {
                $update_data['phone_verified_at'] = date("Y-m-d H:i:s");
                $update_data['phone_verified'] = 1;
                $user = DB::table('biketaxi.users')->where('phone', '=', $input['phone'])->update($update_data);
            }
            return $this->sendResponse($input, 'User data updated successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    // public function login(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'password' => 'required',
    //         'email' => 'required_without:phone',
    //         'phone' => 'required_without:email',
    //     ]);

    //     if ($validator->fails()) {
    //         return $this->sendError('Validation Error.', $validator->errors());
    //     }

    //     if (isset($request->email) && (Auth::guard('api')->attempt(['email' => $request->email, 'password' => $request->password]))) {
    //         $user = Auth::guard('api')->user();
    //         // log::info('user details',[$user]);
    //         $success['token'] =  $user->createToken('MyApp')->plainTextToken;
    //         $success['name'] =  $user->name;
    //         $success['user_id'] =  $user->user_id;
    //         $user->last_login = date("Y-m-d H:i:s");
    //         $user->save();
    //         return $this->sendResponse($success, 'User login successfully.');
    //     } else if (isset($request->phone) && (Auth::guard('api')->attempt(['phone' => $request->phone, 'password' => $request->password, 'is_live' => 1]))) {
    //         $user = Auth::guard('api')->user();
    //         $success['token'] =  $user->createToken('MyApp')->plainTextToken;
    //         $success['name'] =  $user->name;
    //         $success['user_id'] =  $user->user_id;
    //         $user->last_login = date("Y-m-d H:i:s");
    //         $user->save();
    //         return $this->sendResponse($success, 'User login successfully.');
    //     } else {
    //         return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
    //     }
    // }
    //  public function login(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'password' => 'required',
    //         'email' => 'required_without:phone',
    //         'phone' => 'required_without:email',
    //         'device_token' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return $this->sendError('Validation Error.', $validator->errors());
    //     }

    //     if (isset($request->email) && (Auth::guard('api')->attempt(['email' => $request->email, 'password' => $request->password]))) {
    //         $user = Auth::guard('api')->user();
    //         // log::info('user details',[$user]);
    //         $success['token'] =  $user->createToken('MyApp')->plainTextToken;
    //         $success['name'] =  $user->name;
    //         $success['user_id'] =  $user->user_id;
    //         $user->last_login = date("Y-m-d H:i:s");
    //         $user->device_token = $request->device_token;
    //         $user->save();
    //         return $this->sendResponse($success, 'User login successfully.');
    //     } else if (isset($request->phone) && (Auth::guard('api')->attempt(['phone' => $request->phone, 'password' => $request->password, 'is_live' => 1]))) {
    //         $user = Auth::guard('api')->user();
    //         $success['token'] =  $user->createToken('MyApp')->plainTextToken;
    //         $success['name'] =  $user->name;
    //         $success['user_id'] =  $user->user_id;
    //         $user->last_login = date("Y-m-d H:i:s");
    //         $user->device_token = $request->device_token;
    //         $user->save();
    //         return $this->sendResponse($success, 'User login successfully.');
    //     } else {
    //         return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
    //     }
    // }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'email' => 'required_without:phone',
            'phone' => 'required_without:email',
            'device_token' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        //return $request;
        if (isset($request->email) && (Auth::guard('api')->attempt(['email' => $request->email, 'password' => $request->password]))) {
            $user = Auth::guard('api')->user();
            // log::info('user details',[$user]);
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;
            $success['user_id'] =  $user->user_id;
            $success['id'] =  $user->id;
            $user->last_login = date("Y-m-d H:i:s");
            $user->device_token = $request?->device_token;
            $user->save();
            return $this->sendResponse($success, 'User login successfully.');
        } else if (isset($request->phone) && (Auth::guard('api')->attempt(['phone' => $request->phone, 'password' => $request->password]))) {
            $user = Auth::guard('api')->user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;
            $success['user_id'] =  $user->user_id;
            $user->last_login = date("Y-m-d H:i:s");
            $user->device_token = $request?->device_token;
            $success['id'] =  $user->id;
            $user->save();
            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Wrong Credentials', ['error' => 'Unauthorised'], 401); // Explicitly setting status code to 401
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
    public function profileUser(Request $request)
    {
        $user = Auth::guard('api')->user();
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
        $success['address'] = DB::table('user_address')->where('user_id', $user->user_id)->select('address1', 'address2', 'address3', 'city', 'state', 'country', 'postal_code')->first();
        return $this->sendResponse($success, 'User data.');
    }


    /**
     * Driver Login api
     *
     * @return \Illuminate\Http\Response
     */
    // public function driverlogin(Request $request)
    // {

    //     $validator = Validator::make($request->all(), [
    //         'password' => 'required',
    //         'email' => 'required_without:phone',
    //         'phone' => 'required_without:email',
    //     ]);
    //     if ($validator->fails()) {
    //         return $this->sendError('Validation Error.', $validator->errors());
    //     }

    //     if (isset($request->email) && (Auth::guard('api')->attempt(['email' => $request->email, 'password' => $request->password, 'is_driver' => 1]))) {
    //         $user = Auth::guard('api')->user();
    //         // log::info('user details',[$user]);
    //         $success['token'] =  $user->createToken('MyApp')->plainTextToken;
    //         $success['name'] =  $user->name;
    //         $success['user_id'] =  $user->user_id;
    //         $user->last_login = date("Y-m-d H:i:s");
    //         $user->save();
    //         return $this->sendResponse($success, 'Driver login successfully.');
    //     } else if (isset($request->phone) && (Auth::guard('api')->attempt(['phone' => $request->phone, 'password' => $request->password, 'is_live' => 1, 'is_driver' => 1]))) {
    //         $user = Auth::guard('api')->user();
    //         $success['token'] =  $user->createToken('MyApp')->plainTextToken;
    //         $success['name'] =  $user->name;
    //         $success['user_id'] =  $user->user_id;
    //         $user->last_login = date("Y-m-d H:i:s");
    //         $user->save();
    //         return $this->sendResponse($success, 'Driver login successfully.');
    //     } else {
    //         return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
    //     }
    // }



    // public function driverlogincheck(Request $request)
    // {
    //     // $t=DB::table('driver')->first();
    //     // return Hash::make('driver');
    //     // return $request->password."<br>".bcrypt($request->password);
    //     $validator = Validator::make($request->all(), [
    //         'password' => 'required',
    //         'email' => 'required_without:phone',
    //         'phone' => 'required_without:email',
    //     ]);
    //     // $p=Hash::make($request->password);
    //     if ($validator->fails()) {
    //         return $this->sendError('Validation Error.', $validator->errors());
    //     } else {
    //         $t = DB::table('driver')->where('email', $request->email)->get();
    //         if (count($t) != 0) {
    //             if (Hash::check($request->password, $t[0]->password)) {
    //                 $result = DB::table('driver')->where('email', $request->email)->get();
    //                 return $this->sendResponse($result, 'Driver login successfully.');
    //             } else {
    //                 return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
    //             }
    //         } else {
    //             $t1 = DB::table('driver')->where('mobile', $request->phone)->get();
    //             if (count($t1) != 0) {
    //                 if (Hash::check($request->password, $t1[0]->password)) {
    //                     $result = DB::table('driver')->where('mobile', $request->phone)->get();
    //                     return $this->sendResponse($result, 'Driver login successfully.');
    //                 }
    //             } else {
    //                 return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
    //             }
    //         }
    //     }
    // }
    public function driverlogin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'email' => 'required_without:phone',
            'phone' => 'required_without:email',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        if (isset($request->email) && (Auth::guard('api')->attempt(['email' => $request->email, 'password' => $request->password, 'is_driver' => 1]))) {
            $user = Auth::guard('api')->user();
            // log::info('user details',[$user]);
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;
            $success['user_id'] =  $user->user_id;
            $user->last_login = date("Y-m-d H:i:s");
            $user->save();
            return $this->sendResponse($success, 'Driver login successfully.');
        } else if (isset($request->phone) && (Auth::guard('api')->attempt(['phone' => $request->phone, 'password' => $request->password, 'is_live' => 1, 'is_driver' => 1]))) {
            $user = Auth::guard('api')->user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;
            $success['user_id'] =  $user->user_id;
            $user->last_login = date("Y-m-d H:i:s");
            $user->save();
            return $this->sendResponse($success, 'Driver login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }



    public function driverlogincheck010(Request $request)
    {
        // $t=DB::table('driver')->first();
        // return Hash::make('driver');
        // return $request->password."<br>".bcrypt($request->password);
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'email' => 'required_without:phone',
            'phone' => 'required_without:email',
            // "device_token" => "required",
        ]);
        // $p=Hash::make($request->password);
        // if($request->device_token==""){
        //     $request->device_token="";
        // }else{

        // }
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        } else {
            $t = DB::table('driver')->where('email', $request->email)->get();
            if (count($t) != 0) {
                if (Hash::check($request->password, $t[0]->password)) {

                    $result = DB::table('driver')->where('email', $request->email)->get();
                    DB::table('users')->where('id', $result[0]->userid)->update(['last_login' => date("Y-m-d H:i:s"), 'device_token' => $request->device_token, "logout_time" => ""]);
                    return $this->sendResponse($result, 'Driver login successfully.');
                } else {
                    return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
                }
            } else {
                $t1 = DB::table('driver')->where('mobile', $request->phone)->get();
                if (count($t1) != 0) {
                    if (Hash::check($request->password, $t1[0]->password)) {
                        $result = DB::table('driver')->where('mobile', $request->phone)->get();
                        // DB::table('users')->where('phone', $request->phone)->update(['last_login' => date("Y-m-d H:i:s")]);
                        DB::table('users')->where('id', $result[0]->userid)->update(['last_login' => date("Y-m-d H:i:s"), 'device_token' => $request->device_token, "logout_time" => ""]);
                        return $this->sendResponse($result, 'Driver login successfully.');
                    } else {
                        return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
                    }
                } else {
                    return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
                }
            }
        }
    }
    
   public function driverlogincheck(Request $request)
    {
        // $t=DB::table('driver')->first();
        // return Hash::make('driver');
        // return $request->password."<br>".bcrypt($request->password);
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'email' => 'required_without:phone',
            'phone' => 'required_without:email',
            // "device_token" => "required",
        ]);
        // $p=Hash::make($request->password);
        // if($request->device_token==""){
        //     $request->device_token="";
        // }else{

        // }
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        } else {
            $t = DB::table('driver')->where('email', $request->email)->get();
            if (count($t) != 0) {
                if (Hash::check($request->password, $t[0]->password)) {
                    $subscriber = Subscriber::where('id', $t[0]->subscriberId)->first();
                    if ($subscriber->blockedstatus == 1) {
                        $result = DB::table('driver')->where('email', $request->email)->get();
                        DB::table('users')->where('id', $result[0]->userid)->update(['last_login' => date("Y-m-d H:i:s"), 'device_token' => $request->device_token, "logout_time" => ""]);
                        return $this->sendResponse($result, 'Driver login successfully.');
                    } else {
                        return $this->sendError('Unauthorised.', ['error' => 'Unable To Login Now, Your Subscriber Is Currently Blocked']);
                    }
                } else {
                    return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
                }
            } else {
                $t1 = DB::table('driver')->where('mobile', $request->phone)->get();
                //return $t1;
                if (count($t1) != 0) {
                    if (Hash::check($request->password, $t1[0]->password)) {
                        $subscriber = Subscriber::where('id', $t1[0]->subscriberId)->first();
                        if ($subscriber->blockedstatus == 1) {
                            $result = DB::table('driver')->where('mobile', $request->phone)->get();
                            // DB::table('users')->where('phone', $request->phone)->update(['last_login' => date("Y-m-d H:i:s")]);
                            DB::table('users')->where('id', $result[0]->userid)->update(['last_login' => date("Y-m-d H:i:s"), 'device_token' => $request->device_token, "logout_time" => ""]);
                            return $this->sendResponse($result, 'Driver login successfully.');
                        } else {
                            return $this->sendError('Unauthorised.', ['error' => 'Unable To Login Now, Your Subscriber Is Currently Blocked']);
                        }
                    } else {
                        return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
                    }
                } else {
                    return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
                }
            }
        }
    }

    public function pincheck(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pincode' => 'required',

        ]);
        // $p=Hash::make($request->password);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        } else {
            $data = [];
            $c = DB::table('pincode')->where('pincode', $request->input('pincode'))->count();
            if ($c > 0) {
                $data = DB::table('pincode')->where('pincode', $request->input('pincode'))->get();
                return $this->sendResponse($data, 'This pincode is  available.');
            } else {
                return $this->sendError('Pincode Not Available Please Enter Another Pincode.');
            }
        }
    }
    public function notificationtodriver(Request $d)
    {

        $validator = Validator::make(
            $d->all(),
            array(
                'pincode' => 'required'
            )
        );


        if ($validator->fails()) {
            // return response()->json(['status' => 200, "message" => "Pincode Required"]);
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $driverarray = [];
        $pincode = $d->get('pincode');
        $Pincode = Pincode::where('pincode', $pincode)->get();
        foreach ($Pincode as $pin) {
            if ($pin->pincode == $pincode) {

                $driver = Driver::get(['pincode', 'id']);
                foreach ($driver as $drivers) {
                    $driverpin =  json_decode($drivers->pincode);
                    foreach ($driverpin as $p) {
                        if ($p == $pin->id) {
                            //notification for that driver pincode
                            // $user_id = User::where('id', $drivers->id)->get(['user_id']);
                            // if (count($user_id) > 0)
                            array_push($driverarray, $drivers->id);
                        }
                    }
                }
            }
        }
        // $Pincode1 = Pincode::where('pincode', "!=", $pincode)->orderBy('pincode', 'asc')->get();

        // // $driver = Driver::get(['pincode']);
        // // foreach ($driver as $drivers) {
        // //     $driverpin =  json_decode($drivers->pincode);
        // //     foreach ($driverpin as $p) {

        // //         //notification for that driver pincode
        // //         // array_push($driverarray, $drivers->id);

        // //     }
        // // }
        // foreach ($Pincode1 as $pin) {


        //     $driver = Driver::get(['pincode', 'id']);
        //     foreach ($driver as $drivers) {
        //         $driverpin =  json_decode($drivers->pincode);
        //         foreach ($driverpin as $p) {
        //             if ($p == $pin->id) {
        //                 //notification for that driver pincode
        //                 array_push($driverarray, $drivers->id);
        //             }
        //         }
        //     }
        // }
        if (count($driverarray) > 0) {
            return $this->sendResponse(array_unique($driverarray), 'These Are the driver id for the notification');
        } else {
            return $this->sendError("There Is no Such Pincode");
        }
        // return response()->json(['status' => 200, "message" => array_unique($driverarray)]);
    }

    public function userprofile(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "user_id" => 'required'
        ]);
        if ($validate->fails()) {
            return $this->sendError('Validation Error.', $validate->errors());
            // return response()->json(['status' => 200, 'message' => 'message id required']);
        }
        $userid = $request->get('user_id');
        $count =  User::where('user_id', $userid)->count();
       if ($count > 0) {
            // $user = User::where('user_id', $userid)->get(['firstname', 'lastname', 'email', 'phone', 'gender', 'dop']);
            $user = User::where('user_id', $userid)->get(['name', 'email', 'phone', 'gender', 'dob', 'image']);
$useraddress = DB::table('user_address')->where('user_id', $userid)->whereIn('type', ['1', '2'])->get();

$user = json_decode($user, true); // Ensure decoding as associative array
$useraddress = json_decode($useraddress, true);

$mergedAddresses = array_merge($user, $useraddress);

return $this->sendResponse($mergedAddresses, 'User Profile Received Successfully');
            // return response()->json(['status' => 200, 'message' => $useraddress]);
        } else {
            return $this->sendError('There is No Profile With This ID.Please Try Another Id');
        }
    }

    // public function pincheck(Request $d)
    // {
    //     $validate = Validator::make($d->all(), [
    //         "pincode" => 'required'
    //     ]);
    //     if ($validate->fails()) {
    //         return response()->json(['success' => false,'message'=>'Pincode Required']);
    //     }
    //     $c = Pincode::where('pincode', $d->get('pincode'))->count();
    //     if ($c > 0) {
    //         $data = Pincode::where('pincode', $d->get('pincode'))->get();
    //         return response()->json(['success' => true, 'data' => $data,'message'=>'success']);
    //     } else {
    //         return response()->json(['success' => false,'message'=>'Pincode Not Found']);
    //     }
    // }

    // public function logout(Request $d)
    // {
    //     $d->validate(['user_id' => "required"]);
    // }
}
