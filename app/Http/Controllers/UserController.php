<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\SampleMail;
use App\Models\Admin;
use App\Models\Complaints;
use App\Models\Subscriber;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PSpell\Config;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:user-list|user-create|user-edit|user-destroy', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-destroy', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {


        $data = Admin::orderBy('id', 'DESC')->get();
        return view('admin.users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $user=Auth::user()->roles;
        // dd($user);
        $roles = Role::where('guard_name', 'web')->pluck('name', 'name')->all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(env("MAIL_HOST"));
         //dd($request);
        $this->validate($request, [
            'name' => 'required',
            'emp_id' => 'required|unique:admin,emp_id',
            'profile' => 'required',
            'email' => 'required|email|unique:users,email',
            'official_mail' => 'required|email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
            'education' => 'required',
            'blood_group' => 'required',
            'other' => 'nullable',
            'gender' => 'required',
            'mobile' => 'required',
            'official_mobile' => 'required',
            'address' => 'required',
            'current_address' => 'required',
            'aadhar' => 'required',
            'pan' => 'required',
            'joining_date' => 'required',
            'payment' => 'required',
        ]);
        //dd($request->validated());
        $input = $request->all();
        //dd($input['roles']);
        $input['password'] = Hash::make($input['password']);
        $profile = time() . '.' . $request->profile->extension();
        $request->profile->move(public_path('admin/admin/profile'), $profile);
        $input['profile'] = $profile;
        // dd($profile);
        if($request->has('other')){
        $other = time() . '.' . $request->other->extension();
          $request->other->move(public_path('admin/admin/otherDocument'), $other);
        $input['other'] = $other;
        }
      $input['other'] = Null;
        $input['emp_id'] = "Employee ID - " . $request->emp_id;
 //dd($input);
        // dd($other);
        $user = Admin::create($input);
        $user->assignRole($request->input('roles'));
        // Mail::to($request->email)->send(new SampleMail);
        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Admin::find($id);
        // dd($user);
        $userId = $user->id;
        $subscriberCount = Subscriber::where('created_by', $userId)->get()->count();
        $complaintTakenCount = Complaints::where('complained_id', $userId)->get()->count();
        $complaintsolvedCount = Complaints::where('solved_id', $userId)->get()->count();
        //  dd($complaintsolvedCount);
        return view('admin.users.show', compact('user', 'subscriberCount', 'complaintTakenCount', 'complaintsolvedCount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Admin::find($id);
        $roles = Role::where('guard_name', 'web')->pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('admin.users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $this->validate($request, [
            'name' => 'required',
            'profile' => 'nullable',
            'emp_id' => 'required|unique:admin,emp_id,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'official_mail' => 'required|email',
            'password' => 'same:confirm-password',
            'education' => 'required',
            'blood_group' => 'required',
            'other' => 'nullable',
            'roles' => 'required',
            'gender' => 'required',
            'mobile' => 'required',
            'official_mobile' => 'required',
            'address' => 'required',
            'current_address' => 'required',
            'aadhar' => 'required',
            'pan' => 'required',
            'joining_date' => 'nullable',
            'payment' => 'required'
        ]);
        // dd($request);
        $input = $request->all();
        if ($request->hasFile('profile')) {
            $profilename = time() . '.' . $request->profile->extension();
            // dd($profilename);
            $request->profile->move(public_path('admin/admin/profile'), $profilename);
            $input['profile'] = $profilename;
        }

        if ($request->hasFile('other')) {
            $othername = time() . '.' . $request->other->extension();
            $request->other->move(public_path('admin/admin/otherDocument'), $othername);
            $input['other'] = $othername;
        }


        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        //  dd($input);
        $user = Admin::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admin::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
