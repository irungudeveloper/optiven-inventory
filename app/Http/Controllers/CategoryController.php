<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
        $category = Category::all();
        return view('category.index')->with('categories',$category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        return view('category.create');
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
        $category = new Category;

        $validator = $request->validate(['category'=>'required']);

        if ($validator) 
        {
            $category->name = $request->category;
            if ($category->save()) 
            {
                return json_encode(array(['response_code'=>201,
                                          'message'=>'Category Created Succesfully',
                                        ]));         
            }

            return json_encode(array(['response_code'=>500,
                                          'message'=>'Error Occured! Try Again',
                                        ]));         

        }

        return json_encode(array(['response_code'=>301,
                                          'message'=>'Invalid input! Please Try Again',
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
        echo "SHOW";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $category = Category::find($id);
        return view('category.edit')->with('category',$category);

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
        // $name = 

        $category = Category::where('id',$request->id)->update(['name'=>$request->category]);

        if ($category) 
        {
            return json_encode(array([ 'response_code'=>200,
                                       'message'=>'Category Updated Successfully',
                                       
                                ]));
        }

        return json_encode(array(['response_code'=>300,
                                  'message'=>'Category Not Updated',
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
        // echo "DESTROY";

        $category = Category::findOrFail($id);

        if ($category->delete()) 
        {
            return redirect()->route('category.index');
        }

        
        
    }
}
