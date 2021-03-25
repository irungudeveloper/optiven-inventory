<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Category;
use App\Employee;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $order = Order::all();

        return view('order.index')->with('order',$order);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $employee = Employee::all();
        $category = Category::all();

        return view('order.create')->with('category',$category)
                                   ->with('employee',$employee);

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
        $order = new Order;
        $status = 0;

        $validator = $request->validate([
                        'user_id'=>'required',
                        'employee_id'=>'required',
                        'category_id'=>'required',
                    ]);

        if ($validator) 
        {
            $order->user_id = $request->user_id;
            $order->employee_id = $request->employee_id;
            $order->category_id = $request->category_id;
            $order->status = $status;

            if ($order->save()) 
            {
                return json_encode(array([
                            'response_code'=>201,
                            'message'=>'Order Submitted',
                        ]));
            }

            return json_encode(array([
                            'response_code'=>500,
                            'message'=>'Error Occured Please Try Again Later',
                        ]));
        }

        return json_encode(array([
                            'response_code'=>301,
                            'message'=>'Ivalid Input! Please Try Again',
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
