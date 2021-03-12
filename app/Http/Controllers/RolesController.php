<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Roles;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Roles::all();
        return view('role.index')->with('roles',$roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('role.create');
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
        $role = new Roles;
        $success = 201;
        $validation_error = 300;
        $insert_error = 500;

        $validator = $request->validate(['role'=>'required']);

        if ($validator) 
        {
           $role->name = $request->role;
           if ($role->save()) 
           {
             return json_encode(array([
                                        'response_code'=>$success,
                                        'message'=>"User Role Created",
                                        ]));
           }

           return json_encode(array([
                                        'response_code'=>$insert_error,
                                        'message'=>"Insertion Error",
                                    ]));   
        }

         return json_encode(array([
                                        'response_code'=>$validation_error,
                                        'message'=>"Invalid User Input",
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
