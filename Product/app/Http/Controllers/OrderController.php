<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
   
    {
        if(auth::check()){
            return view('order.index');
        }
        else{
           return redirect('/')->with('error','Unauthorized Person');
        }  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order  = new Order;
        $order->user_id = $request->user_id;
        $order->product_id = $request->product_id;
        $order->quantity = $request->qty;
        $order->price = $request->price;
        $order->order_status = 'pending';
        $order->save();
        $product_id = $order->product_id;
        $product = Product::find($product_id);
        $current_quantity = $product->quantity;
        $product->quantity = $current_quantity - $order->quantity;
        $product->save();   
        return response()->json([
            'message'=>'Order Product Successfully',
            'success'=>true,
        ]);
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
    public function getAllOrdersbyUser($id){
        
        $order = Order::join('products', 'products.id', '=', 'orders.product_id')
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->where('user_id','=',$id)->get(['orders.*', 'users.name','users.last_name','users.address','users.mobile_number','products.product_name','products.product_description','products.image_link']);
      
        return response()->json([
            'data'=>$order,
            
            'success'=>true,

        ]);
    }
}
