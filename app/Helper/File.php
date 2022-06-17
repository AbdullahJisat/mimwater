<?php

namespace App\Helper;

// use Illuminate\Support\Str;
// use Intervention\Image\Facades\Image;

Trait File
{
    public function file( $file, $model, $number = 0 )
    {
        if($file) {
            $filename = $model.'-'.$number.'.'.$file->getClientOriginalExtension();
            $image_path = str_ireplace("public/","/storage/", $file->storeAs('public/upload/'.$model.'_image', $filename));
            return $image_path;
        }
    //    if ( $file ) {

    //        $extension       = $file->getClientOriginalExtension();
    //        $file_name       = $path.'-'.Str::random(30).'.'.$extension;
    //        $url             = $file->storeAs($this->public_path,$file_name);
    //        $public_path     = public_path($this->storage_path.$file_name);
    //        $img             = Image::make($public_path)->resize($width, $height);
    //        $url             = preg_replace( "/public/", "", $url );
    //        return $img->save($public_path) ? $url : '';
    //    }
    }
}
