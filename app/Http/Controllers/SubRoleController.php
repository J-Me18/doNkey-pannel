<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SubRoleController extends Controller
{

    // function __construct()
    // {
    //     $this->middleware('permission:role-list|role-create|role-edit|role-destroy', ['only' => ['index', 'store']]);
    //     $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:role-destroy', ['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Session::get('subscribers');

        if ($user->hasPermissionTo('role-list')) {
            $subscriber = Session::get('subscribers');
            // dd($subscriber);
            if(isset($subscriber->subscriberId)){
            $roles = Role::where('guard_name', 'employee')->where('added_by',$subscriber?->id)
                ->orderBy('id', 'DESC')->paginate(5);
                return view('subscriber.roles.index', compact('roles'))
                ->with('i', ($request->input('page', 1) - 1) * 5);
            }
             else{
             //dd($user);
              $roles = Role::where('guard_name', 'employee')->where('added_by',$user?->subscriber_id)
                ->orderBy('id', 'DESC')->paginate(5);
                return view('subscriber.roles.index', compact('roles'))
                ->with('i', ($request->input('page', 1) - 1) * 5);
        
        }
        }
       
        return view('subscriber.403');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Session::get('subscribers');

        if ($user->hasPermissionTo('role-create')) {
            $permission = Permission::where('guard_name', 'employee')->get();
            return view('subscriber.roles.create', compact('permission'));
        }

        return view('subscriber.403');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    //dd($request);
    $this->validate($request, [
        'name' => 'required|unique:roles,name',
        'permission' => 'required',
        'added_by' => 'nullable'
    ]);
    $subscriber = Session::get('subscribers'); // Added semicolon here
    //dd($subscriber);
    if (isset($subscriber->subscriberId)){
    //dd("hii");
        $role = Role::create(['name' => $request->input('name'), 'guard_name' => 'employee', 'added_by' => $subscriber->id]);
        //dd($role);
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully');
    }
    else{
    
     $role = Role::create(['name' => $request->input('name'), 'guard_name' => 'employee', 'added_by' => $subscriber->subscriber_id]);
        //dd($role);
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully');
    }
    //dd("hlo"); 
}


    public function subPermission()
    {
        Permission::create(['name' => 'role-list', 'guard_name' => 'employee']);
        Permission::create(['name' => 'role-create', 'guard_name' => 'employee']);
        Permission::create(['name' => 'role-edit', 'guard_name' => 'employee']);
        Permission::create(['name' => 'role-destroy', 'guard_name' => 'employee']);
        Permission::create(['name' => 'emp-rider-list', 'guard_name' => 'employee']);
        Permission::create(['name' => 'rider-create', 'guard_name' => 'employee']);
        Permission::create(['name' => 'rider-edit', 'guard_name' => 'employee']);
        Permission::create(['name' => 'rider-destroy', 'guard_name' => 'employee']);
        Permission::create(['name' => 'category-price', 'guard_name' => 'employee']);
        Permission::create(['name' => 'employee-list', 'guard_name' => 'employee']);
        Permission::create(['name' => 'employee-create', 'guard_name' => 'employee']);
        Permission::create(['name' => 'employee-edit', 'guard_name' => 'employee']);
        Permission::create(['name' => 'employee-destroy', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Chat', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Status on', 'guard_name' => 'employee']);
        Permission::create(['name' => 'complaint-list', 'guard_name' => 'employee']);
         Permission::create(['name' => 'enquiry-list', 'guard_name' => 'employee']);

        return "Permission Created";
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        return view('subscriber.roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Session::get('subscribers');

        if ($user->hasPermissionTo('role-edit')) {
            $role = Role::find($id);
            $permission = Permission::where('guard_name', 'employee')->get();
            $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
                ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
                ->all();

            return view('subscriber.roles.edit', compact('role', 'permission', 'rolePermissions'));
        }

        return view('subscriber.403');
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
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
        $subscriber = Session::get('subscribers'); // Added semicolon here
    //dd($subscriber);
   
     if (isset($subscriber->subscriberId)){
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully');
            }
            else{
            $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully');
            }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Session::get('subscribers');

        if ($user->hasPermissionTo('role-destroy')) {
            DB::table("roles")->where('id', $id)->delete();
            return redirect()->route('roles.index')
                ->with('success', 'Role deleted successfully');
        }

        return view('subscriber.403');
    }
}

