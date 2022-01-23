<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use DB;
use Auth;
class ProductController extends Controller
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


          $this->validate($request, [
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'product_image'=>'required'
  
        ]);
        $product = new Product;
        $product->product_name = $request->title;
        $product->product_description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->image_link = $request->product_image;
        $product->status = $request->status;
        $product->save();
        $product_id = $product->id;
        DB::table('product_user')->insert([
            'user_id' => $request->user_id,
            'product_id' => $product_id,
            'created_at' => date("Y-m-d"),
            ]);
      return response()->json(['success'=>true,'message'=>'Product Created Successfully',]);
    }
    public function imageUpload(Request $request){
        $image = $request->product_image;
        $upload_preset = 'a5pn3al6';
        $cloudinary = cloudinary()->uploadApi()->unsignedUpload($image,$upload_preset , $options = []);
        return response()->json(['success'=>true,'data_url'=>$cloudinary]);
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
        $product = Product::find($id);
        $product->product_name = $request->title;
        $product->product_description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->image_link = $request->product_image;
        $product->status = $request->status;
        $product->save();
        return response()->json(['success'=>true,'message'=>'Product Updated Successfully',]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrfail($id);
        $product->delete();
        return response()->json([
            'success'=>true,
            'message'=>'Product Deleted Successfully'
        ]);
    }
    public function getAllProductsByUser($id){
        $product = User::with('Product')->where('id','=',$id)->get();
        return response()->json([
            'data'=>$product,
            'success'=>true
        ]);
    }
    public function getAllProducts(){
        $product = Product::with('User')->where('quantity','>',0)->get();
        return response()->json([
            'data'=>$product,
            'success'=>true
        ]);
    }
}
