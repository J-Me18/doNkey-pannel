<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subscriber\Employee\StoreEmployeeRequest;
use App\Http\Requests\Subscriber\Employee\UpdateEmployeeRequest;
use App\Models\Employee;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class SubEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Session::get('subscribers');
        $user = Session::get('subscribers');
        // dd($user);
        if (isset($user->subscriberId)) {
            $employees = Employee::where('subscriber_id', $user->id)
                ->latest()
                ->get();
        } else {
            // dd($user);
           
            $employees = Employee::where('subscriber_id', $user->subscriber_id)
                ->where('employee_id', $user->id)
                ->latest()
                ->get();
        }

        return view('subscriber.employee.index', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Session::get('subscribers');
//dd($user);
        if ($user->hasPermissionTo('employee-create')) {
            $roles = Role::where('guard_name', 'employee')->where('added_by',$user->id)->get();
            return view('subscriber.employee.create', ['roles' => $roles]);
        }

        return view('subscriber.403');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        //  dd($request);
        //  dd($request->validated());
        $employee = Employee::create($request->validated());
        $role = Role::where('name', $request['role'])->where('guard_name', 'employee')->first();
        // dd($role);
        // dd($role->name);
        // dd($employee);
        $employee->assignRole($role->name);
        return redirect()->route('subEmployee.index')->with('success', "Employee Created Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('subscriber.employee.show', ['employee' => $employee]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $user = Session::get('subscribers');

        if ($user->hasPermissionTo('employee-edit')) {
            // dd($employee->roles);

            $roles = Role::where('guard_name', 'employee')->pluck('name', 'name')->all();
            $userRoles = $employee->roles->pluck('name', 'name')->all();
            // dd($userRoles);
            return view('subscriber.employee.edit', ['employee' => $employee, 'roles' => $roles, 'userRoles' => $userRoles]);
        }

        return view('subscriber.403');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        // dd($request->validated());
        $employee->update($request->validated());
        // $subscriber = $employee;
        $employee->roles()->detach();

        if ($request->has('role')) {
            $roles = $request->input('role');
            $employee->assignRole($roles);
        }


        return redirect()->route('subEmployee.index')->with('success', "Employee Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $user = Session::get('subscribers');

        if ($user->hasPermissionTo('employee-destroy')) {
            $employee->delete();
            return back()->with('success', "Employee Deleted Successfully");
        }

        return view('subscriber.403');
    }
}

