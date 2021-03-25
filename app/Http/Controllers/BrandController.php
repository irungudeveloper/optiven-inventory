<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $brand = Brand::all();
        return view('brand.index')->with('brand',$brand);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('brand.create');
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
        $brand = new Brand;

        $validator = $request->validate(['brand'=>'required']);

        if ($validator) 
        {
           $brand->name = $request->brand;
           if ($brand->save()) 
           {
               return response(array([  'response_code'=>201,
                                        'respose_message'=>'Brand Created Successfully',
                                     ]));
           }
                return response(array([  'response_code'=>500,
                                        'respose_message'=>'Insertion Error Please Try Again',
                                     ]));
        }

        return response(array([  'response_code'=>301,
                                        'respose_message'=>'Invalid Input',
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
        $brand = Brand::find($id);

        return view('brand.edit')->with('brand',$brand); 
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
         $brand = Brand::where('id',$request->id)->update(['name'=>$request->brand]);

        if ($brand) 
        {
            return json_encode(array([ 'response_code'=>200,
                                       'message'=>'Brand Updated Successfully',
                                       
                                ]));
        }

        return json_encode(array(['response_code'=>300,
                                  'message'=>'Brand Not Updated',
                                ]));
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
        $brand = Brand::findOrFail($id);

        if ($brand->delete()) 
        {
            return redirect()->route('brand.index');
        }
            
    }
}
