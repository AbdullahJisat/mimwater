<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use Image;
Use Carbon\Carbon;

class TeamController extends Controller
{

    public function addteam(){
    	return view('backend.team.addteam');
    }

    public function storeteam(Request $request){
    	// $validateData = $request->validate([
    	// 	'image' => 'required|image|mimes:jpg,png,jpeg',
        //     'team_name' => 'required',
    	// ],
    	// [
    	// 	'team.mimes' => 'team Image must be of jpg,png,jpeg format',
        //     'team_name.required' => 'Provide a good team Title for SEO',
    	// ]);


		//
		if($request->hasFile('image')) {
            $file = $request->file('image') ;
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'/admin/team' ;
            $file->move($destinationPath,$fileName);
    	}
		//

    	// $image = $request->file('team');
    	// $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	// Image::make($image)->resize(1017,400)->save('admin/team/'.$name_gen);
    	// $save_url = 'admin/team/'.$name_gen;
    Team::insert([
      	'image' => 'admin/team/'.$fileName,
        'name' => $request->name,
        'designation' => $request->designation,
        'category' => $request->category,
      	'created_at' => Carbon::now(),
  	 ]);
    	$notification = array(
            'message' => 'team Added Successfully',
            'alert-type' => 'success',
        );
      return redirect()->route('team.list')->with($notification);
    }

    public function teamlist(){
    	$teams = Team::all();
    	return view('backend.team.listteam',compact('teams'));
    }

   public function changeStatus($id){
    	$status = Team::findOrFail($id)->status;
    	if($status == 1){
    		Team::findOrFail($id)->update(['status' => 0]);
    		$notification = array(
            'message' => 'team Disabled Successfully',
            'alert-type' => 'warning',
        );
      		return redirect()->back()->with($notification);
    	}else{
    		Team::findOrFail($id)->update(['status' => 1]);
    		 $notification = array(
            'message' => 'team Enabled Successfully',
            'alert-type' => 'success',
        );
      		return redirect()->back()->with($notification);
    	}
    }

    public function deleteteam($id){
    	$team = Team::findOrFail($id);
		unlink($team->image);
		Team::findOrFail($id)->delete();

		
		$notification = array(
            'message' => 'team Deleted Successfully',
            'alert-type' => 'error',
        );
		return redirect()->back()->with($notification);
    }

	public function edit($id)
    {

        $team=Team::find($id);
        return view('backend.team.editteam', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request){
		
		
        $teams = Team::find($id);
		if($request->hasFile('image')) {
            $file = $request->file('image') ;
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'/admin/team' ;
            $file->move($destinationPath,$fileName);
    	}
        $teams->update([
            'image' => 'admin/team/'.$fileName,
          'name' => $request->name,
          'designation' => $request->designation,
          'category' => $request->category,

          
            'created_at' => Carbon::now(),
         ]);
    	$save_url = 'admin/team/'.$fileName;
          $teams->image = $save_url;
          $teams->save();
            return redirect('team/all-teams');
      }

}