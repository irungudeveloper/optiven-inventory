<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Departments;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employee = Employee::all();
        return view('employee.index')->with('employee',$employee);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $department = Departments::all();
        return view('employee.create')->with('department',$department);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $employee = new Employee;

        $validator = $request->validate([
                        'sir_name'=>'required',
                        'other_name'=>'required',
                        'department_id'=>'required',
                        'phone_number'=>'required',
                        'email'=>'required',
                ]);

        if ($validator) 
        {
            $employee->sir_name = $request->sir_name;
            $employee->other_name = $request->other_name;
            $employee->department_id = $request->department_id;
            $employee->phone_number = $request->phone_number;
            $employee->email = $request->email;

            if ($employee->save()) 
            {
                return response(array([
                                        'response_code'=>201,
                                        'response_message'=>'Employee Record Created Successfully',  
                                    ]));
            }
                 return response(array([
                                        'response_code'=>500,
                                        'response_message'=>'Error Occured When Storing Record! Please Try Again',  
                                    ]));
        }

         return response(array([
                                        'response_code'=>301,
                                        'response_message'=>'Invalid Input, Please Try Again',  
                                    ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
         $employee = Employee::findOrFail($id);
         $department = Departments::all();

         return view('employee.edit')->with('department',$department)
                                     ->with('employee',$employee);
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
        //
         $employee = Employee::where('id',$request->id)
                                ->first()
                                ->update([
                                            'sir_name'=>$request->sir_name,
                                            'other_name'=>$request->other_name,
                                            'phone_number'=>$request->phone_number,
                                            'email'=>$request->email,
                                            'department_id'=>$request->department_id,
                                            ]);

        if ($employee) 
        {
            return json_encode(array(['response_code'=>200]));
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
        //
        $employee = Employee::findOrFail($id);

        if ($employee->delete()) 
        {
            return redirect()->route('employee.index');
        }
    }
}
