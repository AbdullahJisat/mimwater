<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallary;
use Illuminate\Http\Request;
use Image;
Use Carbon\Carbon;

class GallaryController extends Controller
{
   
    public function addgallary(){
    	return view('backend.gallary.addgallary');
    }

    public function storegallary(Request $request){
    	// $validateData = $request->validate([
    	// 	'image' => 'required|image|mimes:jpg,png,jpeg',
        //     'seo_key' => 'required',
    	// ],
    	// [
    	// 	'gallary.mimes' => 'gallary Image must be of jpg,png,jpeg format',
        //     'seo_key.required' => 'Provide a good gallary Title for SEO',
    	// ]);


		//
		if($request->hasFile('gallary_image')) {
            $file = $request->file('gallary_image') ;
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'/admin/gallary_image' ;
            $file->move($destinationPath,$fileName);
    	}
		//

    	// $image = $request->file('gallary');
    	// $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	// Image::make($image)->resize(1017,400)->save('admin/gallary/'.$name_gen);
    	// $save_url = 'admin/gallary/'.$name_gen;
    Gallary::insert([
      	'gallary_image' => 'admin/gallary_image/'.$fileName,
        'seo_key' => $request->seo_key,
      	'created_at' => Carbon::now(),
  	 ]);
    	$notification = array(
            'message' => 'gallary Added Successfully',
            'alert-type' => 'success',
        );
      return redirect()->route('gallary.list')->with($notification);
    }

    public function gallarylist(){
    	$gallarys = Gallary::all();
    	return view('backend.gallary.listgallary',compact('gallarys'));
    }

   public function changeStatus($id){
    	$status = Gallary::findOrFail($id)->status;
    	if($status == 1){
    		Gallary::findOrFail($id)->update(['status' => 0]);
    		$notification = array(
            'message' => 'gallary Disabled Successfully',
            'alert-type' => 'warning',
        );
      		return redirect()->back()->with($notification);
    	}else{
    		Gallary::findOrFail($id)->update(['status' => 1]);
    		 $notification = array(
            'message' => 'gallary Enabled Successfully',
            'alert-type' => 'success',
        );
      		return redirect()->back()->with($notification);
    	}
    }

    public function deletegallary($id){
    	$gallary = Gallary::findOrFail($id);
		unlink($gallary->gallary_image);
		Gallary::findOrFail($id)->delete();

		
		$notification = array(
            'message' => 'gallary Deleted Successfully',
            'alert-type' => 'error',
        );
		return redirect()->back()->with($notification);
    }

	public function edit($id)
    {

        $gallary=Gallary::find($id);
        return view('backend.gallary.editgallary', compact('gallary'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request){
		
		
        $gallarys = Gallary::find($id);
		if($request->hasFile('gallary_image')) {
            $file = $request->file('gallary_image') ;
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'/admin/gallary_image' ;
            $file->move($destinationPath,$fileName);
    	}
        $gallarys->update([
            'gallary_image' => 'admin/gallary_image/'.$fileName,
          'seo_key' => $request->seo_key,
          
            'created_at' => Carbon::now(),
         ]);
    	$save_url = 'admin/gallary_image/'.$fileName;
          $gallarys->gallary_image = $save_url;
          $gallarys->save();
            return redirect('gallary/all-gallarys');
      }

}