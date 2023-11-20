<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Image;
Use Carbon\Carbon;

class AboutController extends Controller
{
    public function addabout(){
    	return view('backend.about.addabout');
    }

    public function storeabout(Request $request){
 
		if($request->hasFile('image')) {
            $file = $request->file('image') ;
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'/admin/image' ;
            $file->move($destinationPath,$fileName);
    	}

    About::insert([
      	'image' => 'admin/image/'.$fileName,
        'description' => $request->description,
      	'created_at' => Carbon::now(),
  	 ]);
    	$notification = array(
            'message' => 'about Added Successfully',
            'alert-type' => 'success',
        );
      return redirect()->route('about.list')->with($notification);
    }

    public function aboutlist(){
    	$abouts = About::paginate(10);
    	return view('backend.about.listabout',compact('abouts'));
    }

//    public function changeStatus($id){
//     	$status = About::findOrFail($id)->status;
//     	if($status == 1){
//     		About::findOrFail($id)->update(['status' => 0]);
//     		$notification = array(
//             'message' => ' Disabled Successfully',
//             'alert-type' => 'warning',
//         );
//       		return redirect()->back()->with($notification);
//     	}else{
//     		About::findOrFail($id)->update(['status' => 1]);
//     		 $notification = array(
//             'message' => ' Enabled Successfully',
//             'alert-type' => 'success',
//         );
//       		return redirect()->back()->with($notification);
//     	}
//     }

    public function deleteabout($id){
    	$about = About::findOrFail($id);
		unlink($about->image);
		About::findOrFail($id)->delete();

		
		$notification = array(
            'message' => 'about Deleted Successfully',
            'alert-type' => 'error',
        );
		return redirect()->back()->with($notification);
    }

	public function edit($id)
    {

        $about=About::find($id);
        return view('backend.about.editabout', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request){
		
		
        $abouts = About::find($id);
		if($request->hasFile('image')) {
            $file = $request->file('image') ;
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'/admin/image' ;
            $file->move($destinationPath,$fileName);
    	}
        $abouts->update([
            'image' => 'admin/image/'.$fileName,
          'description' => $request->description,
          
            'created_at' => Carbon::now(),
         ]);
    	$save_url = 'admin/image/'.$fileName;
          $abouts->image = $save_url;
          $abouts->save();
            return redirect()->route('about.list');
      }
}
