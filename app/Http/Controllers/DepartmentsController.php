<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departments;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $department = Departments::all();
        return view('department.index')->with('department',$department);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('department.create');
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
        $department = new Departments;

        $validator = $request->validate(['department'=>'required']);

        if ($validator) 
        {
            $department->name = $request->department;

            if ($department->save()) 
            {
                return json_encode(array([
                                        'response_code'=>201,
                                        'response_message'=>"Department Created Successfully",
                                    ]));   
            }
            return json_encode(array([
                                        'response_code'=>500,
                                        'response_message'=>"Internal Server Error! Try Again",
                                    ]));   
        }

        return json_encode(array([
                                        'response_code'=>301,
                                        'response_message'=>"Invalid Input! Please Try Again",
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
    }
}
