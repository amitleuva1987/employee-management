<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session()->has('company_id')) {
            session()->forget('company_id');
        }
        // list all employees
        // $employees_using_preceure = DB::select("call get_employees()");
        $employees = Employee::with('company')->get();
        $companies = Company::all(['company_id', 'company_name']);

        return view('employee.index', compact('employees', 'companies')); //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // create employee form
        $companies = Company::all(['company_id', 'company_name']);

        return view('employee.add_employee', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $image_name = $request->image->getClientOriginalName();
        $data = array_merge($request->validated(), ['image' => $image_name]);

        $employee = Employee::create($data);

        $path = Storage::disk('local')->putFileAs('employees/'.$employee->employee_id.'/', $request->file('image'), $image_name);
        //    $path = Storage::disk('s3')->putFileAs('employees/'.$employee->employee_id.'/', $request->file('image'),$image_name);

        if ($employee) {
            return redirect()->route('employees.index')->with('message', 'Employee created successfully!');
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
        $companies = Company::all(['company_id', 'company_name']);

        return view('employee.edit_employee', compact('employee', 'companies'));
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
        $employee->company_id = $request->company_id;
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email_address = $request->email_address;
        $employee->position = $request->position;
        $employee->city = $request->city;
        $employee->country = $request->country;
        $employee->status = $request->status;

        $employee->update();

        return redirect()->route('employees.index')->with('message', 'Employee updated successfully!');
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
        if (Storage::disk('local')->exists('employeess/X1BHzhpwTxUur69g22lTH6Bf4vlC21pSdXM0LlTX.jpg')) {
            Storage::disk('local')->delete('employeess/X1BHzhpwTxUur69g22lTH6Bf4vlC21pSdXM0LlTX.jpg');
        }
        // if(Storage::disk('s3')->exists('employeess/X1BHzhpwTxUur69g22lTH6Bf4vlC21pSdXM0LlTX.jpg')) {
        //     Storage::disk('s3')->delete('employeess/X1BHzhpwTxUur69g22lTH6Bf4vlC21pSdXM0LlTX.jpg');
        // }
        $employee->delete();

        return redirect()->route('employees.index')->with('message', 'Employee deleted successfully!');
    }

    public function get_avtar($id, $image)
    {
        return Storage::disk('local')->get('employees/'.$id.'/'.$image);
        //    return Storage::disk('s3')->get('employees/'.$id.'/'.$image);
    }
}
