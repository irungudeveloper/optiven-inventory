<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use App\Category;
use App\Brand;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $inventory = Inventory::all();

        return view('inventory.index')->with('inventory',$inventory);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category = Category::all();
        $brand = Brand::all();

        return view('inventory.create')->with('category',$category)
                                       ->with('brand',$brand);
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
        $inventory = new Inventory;

        $validator = $request->validate([
                                    'serial_number'=>'required',
                                    'model_number'=>'required',
                                    'category_id'=>'required',
                                    'brand_id'=>'required',
                                    'description'=>'required',
                                ]);
        if ($validator) 
        {
            $inventory->serial_number = $request->serial_number;
            $inventory->model_number = $request->model_number;
            $inventory->category_id = $request->category_id;
            $inventory->brand_id = $request->brand_id;
            $inventory->description = $request->description;
            $inventory->availability = 1;

            if ($inventory->save()) 
            {
                return json_encode(array(['response_code'=>201,
                                           'response_message'=>'Inventory Item Added Successfully',
                                        ]));
            }

            return json_encode(array(['response_code'=>500,
                                           'response_message'=>'Error When Inserting! PLease Try Again',
                                        ]));
        }

        return json_encode(array(['response_code'=>301,
                                           'response_message'=>'Invalid Input',
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
         $category = Category::all();
         $brand = Brand::all();
         $inventory = Inventory::findOrFail($id);

         return view('inventory.edit')->with('category',$category)
                                      ->with('brand',$brand)
                                      ->with('inventory',$inventory);
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
         $inventory = Inventory::where('id',$request->id)
                                ->first()
                                ->update([
                                            'serial_number'=>$request->serial_number,
                                            'model_number'=>$request->model_number,
                                            'category_id'=>$request->category_id,
                                            'brand_id'=>$request->brand_id,
                                            'description'=>$request->description,
                                            ]);

        if ($inventory) 
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
        $inventory = Inventory::findOrFail($id);

        if ($inventory->delete()) 
        {
            return redirect()->route('inventory.index');
        }
    }
}
