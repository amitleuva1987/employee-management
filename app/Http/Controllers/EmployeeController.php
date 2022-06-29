<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session()->has('company_id')){
            session()->forget('company_id');
        }
        // list all employees
     // $employees_using_preceure = DB::select("call get_employees()");
        $employees = Employee::with('company')->get(); 
        $companies = Company::all(['company_id','company_name']);
        
        return view('employee.index',compact('employees','companies')); // 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // create employee form
        $companies = Company::all(['company_id','company_name']);
        
        return view('employee.add_employee',compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email_address' => 'required|email',
            'position' => 'required|max:255',
            'city' => 'required|max:255',
            'country' => 'required|max:255',
            'status' => 'required'
        ]);

        $employee = Employee::create([
            'company_id' => $request->company_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email_address' => $request->email_address,
            'position' => $request->position,
            'city' => $request->city,
            'country' => $request->country,
            'status' => $request->status
        ]);

        if($employee){
            return redirect()->route('employees.index')->with('message','Employee created successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        // Edit employee form
        $companies = Company::all(['company_id','company_name']);
        return view('employee.edit_employee',compact('employee','companies'));        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        // update employee
        $request->validate([
            'company_name' => 'required',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email_address' => 'required|email',
            'position' => 'required|max:255',
            'city' => 'required|max:255',
            'country' => 'required|max:255',
            'status' => 'required'
        ]);
        
        
        $employee->company_id = $request->company_name;
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email_address = $request->email_address;
        $employee->position = $request->position;
        $employee->city = $request->city;
        $employee->country = $request->country;
        $employee->status = $request->status;

        if($employee->isDirty()){

        $employee->save();

        return redirect()->route('employees.index')->with('message','Employee updated successfully!');
        } else {
        return redirect()->back()->with('error','You have made no changes in the employee detail.');    
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        // delete employee
        $employee->delete();
        return redirect()->route('employees.index')->with('message','Employee deleted successfully!');
    }
}
