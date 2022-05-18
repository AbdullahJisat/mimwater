<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Image;
Use Carbon\Carbon;

class ProductController extends Controller
{
   
    public function addproduct(){
    	return view('backend.product.addproduct');
    }

    public function storeproduct(Request $request){
    	// $validateData = $request->validate([
    	// 	'image' => 'required|image|mimes:jpg,png,jpeg',
        //     'product_name' => 'required',
    	// ],
    	// [
    	// 	'product.mimes' => 'product Image must be of jpg,png,jpeg format',
        //     'product_name.required' => 'Provide a good product Title for SEO',
    	// ]);


		//
		if($request->hasFile('product_image')) {
            $file = $request->file('product_image') ;
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'/admin/product_image' ;
            $file->move($destinationPath,$fileName);
    	}
		//

    	// $image = $request->file('product');
    	// $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	// Image::make($image)->resize(1017,400)->save('admin/product/'.$name_gen);
    	// $save_url = 'admin/product/'.$name_gen;
    Product::insert([
      	'product_image' => 'admin/product_image/'.$fileName,
        'product_name' => $request->product_name,
        'details' => $request->details,
        
      	'created_at' => Carbon::now(),
  	 ]);
    	$notification = array(
            'message' => 'product Added Successfully',
            'alert-type' => 'success',
        );
      return redirect()->route('product.list')->with($notification);
    }

    public function productlist(){
    	$products = Product::all();
    	return view('backend.product.listproduct',compact('products'));
    }

   public function changeStatus($id){
    	$status = Product::findOrFail($id)->status;
    	if($status == 1){
    		Product::findOrFail($id)->update(['status' => 0]);
    		$notification = array(
            'message' => 'product Disabled Successfully',
            'alert-type' => 'warning',
        );
      		return redirect()->back()->with($notification);
    	}else{
    		Product::findOrFail($id)->update(['status' => 1]);
    		 $notification = array(
            'message' => 'product Enabled Successfully',
            'alert-type' => 'success',
        );
      		return redirect()->back()->with($notification);
    	}
    }

    public function deleteproduct($id){
    	$product = Product::findOrFail($id);
		unlink($product->product_image);
		Product::findOrFail($id)->delete();

		
		$notification = array(
            'message' => 'product Deleted Successfully',
            'alert-type' => 'error',
        );
		return redirect()->back()->with($notification);
    }

	public function edit($id)
    {

        $product=Product::find($id);
        return view('backend.product.editproduct', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request){
		
		
        $products = Product::find($id);
		if($request->hasFile('product_image')) {
            $file = $request->file('product_image') ;
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'/admin/product_image' ;
            $file->move($destinationPath,$fileName);
    	}
        $products->update([
            'product_image' => 'admin/product_image/'.$fileName,
          'product_name' => $request->product_name,
          'details' => $request->details,
         

          
            'created_at' => Carbon::now(),
         ]);
    	$save_url = 'admin/product_image/'.$fileName;
          $products->product_image = $save_url;
          $products->save();
            return redirect('product/all-products');
      }

}