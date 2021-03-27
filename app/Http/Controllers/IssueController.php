<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Category;
use App\Order;
use DB;
use App\Inventory;
use App\issued;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $issue_items = Issued::all();

        return view('issued.index')->with('issue',$issue_items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $category = DB::table('category')
                        ->join('orders','category.id','=','orders.category_id')
                        ->groupBy('orders.category_id')
                        ->where('orders.status',0)
                        ->get();

        $employee = DB::table('employee')
                        ->join('orders','employee.id','=','orders.employee_id')
                        ->join('departments','employee.department_id','=','departments.id')
                        ->groupBy('orders.employee_id')
                        ->where('orders.status',0)
                        ->get();

        return view('issued.create')->with('category',$category)
                                    ->with('employee',$employee); 

    }

    public function getPendingItems(Request $request)
    {
        $category_id = $request->category_id;
        $order = DB::table('orders')
                    ->join('employee','orders.employee_id','=','employee.id')
                    ->join('departments','employee.department_id','=','departments.id')
                    // ->select('departments.name as department_name')
                    ->join('category','category.id','=','orders.category_id')
                    ->where('orders.status',0)
                    ->where('orders.category_id',$category_id)
                    ->select('orders.id','orders.status','category.name as category_name','departments.name as department_name','employee.sir_name as sir_name','employee.other_name as other_name')
                    ->get();

        return json_encode(array(['Data'=>$order,]));
    }

    public function getPendingEmployee(Request $request)
    {
        // return json_encode(array(['response'=>'Reached']));

        $employee_id = $request->employee_id;
        $order = DB::table('orders')
                    ->join('employee','orders.employee_id','=','employee.id')
                    ->join('departments','employee.department_id','=','departments.id')
                    // ->select('departments.name as department_name')
                    ->join('category','category.id','=','orders.category_id')
                    ->where('orders.status',0)
                    ->where('orders.employee_id',$employee_id)
                    ->select('orders.id','orders.status','category.name as category_name','departments.name as department_name','employee.sir_name as sir_name','employee.other_name as other_name')
                    ->get();

        return json_encode(array(['Data'=>$order,]));
    }

    public function getAvailableInventory(Request $request)
    {
        $category = $request->category;
        
        $inventory = Inventory::where('category_id',$category)
                            ->where('availability',1)
                            ->get();

        return json_encode(array(['Data'=>$inventory,]));
    }

    public function setPendingItem(Request $request)
    {
         $order = Order::where('id',$request->id)->update(['status'=>1]);

         return json_encode(array(['response'=>'order status changed']));
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

        $status = 0;
        $issue = new Issued;

        // $inventory = Inventory::find($request->inventory_id);

        $validator = $request->validate([
                        'employee_id'=>'required',
                        'inventory_id'=>'required',
                        'return_date'=>'required',
                    ]);

        if ($validator) 
        {
            $issue->inventory_id = $request->inventory_id;
            $issue->employee_id = $request->employee_id;
            $issue->expected_return_date = $request->return_date;
            $issue->status = $status;

            if ($issue->save()) 
            {

                $inventory=Inventory::where('id',$request->inventory_id)->update(['availability'=>0]);

                 return json_encode(array(['response'=>'data created']));
            }
            else
            {
                 return json_encode(array(['response'=>'error creating data']));
            }
        }

        return json_encode(array(['response'=>'data invalid! please try again']));
    }

    public function returnIssuedItem(Request $request)
    {
        $inventory = Inventory::where('id',$request->inventory_id)->update(['availability'=>1]);
        
        $issue = Issued::where('id',$request->issue_id)->update(['status'=>1]);
        
       if ($inventory && $issue) 
       {
            return json_encode(array(['response'=>'Item returned successfully']));
       }
       else
       {
           return json_encode(array(['response'=>'Error occured'])); 
       }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 115/1191   40107
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
        $issue = Issued::findOrFail($id);
        $category = DB::table('category')
                        ->join('orders','category.id','=','orders.category_id')
                        ->groupBy('orders.category_id')
                        ->where('orders.status',0)
                        ->get();

        $employee = DB::table('employee')
                        ->join('orders','employee.id','=','orders.employee_id')
                        ->join('departments','employee.department_id','=','departments.id')
                        ->groupBy('orders.employee_id')
                        ->where('orders.status',0)
                        ->get();

        return view('issued.edit')->with('issue',$issue)
                                  ->with('category',$category)
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
        $issue = Issued::where('id',$request->id)
                          ->first()
                          ->update([
                                     'employee_id'=>$request->employee_id,
                                     'inventory_id'=>$request->inventory_id,
                                     'expected_return_date'=>$request->return_date,
                                    ]);
        if ($issue) 
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
        $issue = Issued::findOrFail($id);

        if ($issue->delete()) 
        {
            return redirect()->route('issue.index');
        }
    }
}
