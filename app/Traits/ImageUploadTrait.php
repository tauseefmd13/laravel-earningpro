<?php

namespace App\Traits;
use Image;

trait ImageUploadTrait
{
	public function uploadMedia($file, $path = null, $old_image = null)
	{
		if (! file_exists(public_path('uploads'))) {
            mkdir(public_path('uploads'), 0777);
        }

        if ($path != null) {
            if (! file_exists(public_path('uploads'.'/'.$path))) {
                mkdir(public_path('uploads'.'/'.$path), 0777);
            }
            if (! file_exists(public_path('uploads'.'/'.$path.'/thumbnail'))) {
                mkdir(public_path('uploads'.'/'.$path.'/thumbnail'), 0777);
            }
        }

        // Get filename with extension
        $filenameWithExt = $file->getClientOriginalName();

        // Get file name
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        // Remove unwanted characters
        $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
        $filename = preg_replace("/\s+/", '-', $filename);
        $filename = strtolower($filename);

        // Get the original image extension
        $extension = $file->getClientOriginalExtension();

        // Create unique file name
        $fileNameToStore = $filename.'_'.time().'.'.$extension;

        /*Create thumbnail image code start*/
        $this->resizeImage($file, $path, $fileNameToStore);
        /*Create thumbnail image code end*/

        $destinationPath = public_path() . '/uploads/' . $path . '/';
        $file->move($destinationPath, $fileNameToStore);

        // Remove old image from folder
        $this->unlinkMedia($path, $old_image);
        
        return $fileNameToStore;
	}

    public function unlinkMedia($path, $old_image = null)
    {
        if($old_image != null) {
            @unlink(public_path().'/uploads/'. $path . '/thumbnail/' .$old_image);
            @unlink(public_path().'/uploads/'. $path . '/' .$old_image);

            return true;
        }

        return false;
    }

    public function resizeImage($file, $path, $fileNameToStore)
    {
        if($path != null && $path == 'sliders') {
            $width = 1920;
            $height = 826;
        } else {
            $width = 405;
            $height = 477;
        }

        // upload path
        $destinationPathThumbnail = public_path() . '/uploads/' . $path . '/thumbnail/';

        // create instance
        $img = Image::make($file->path());

        // resize image to fixed size
        $img->resize($width, $height)->save($destinationPathThumbnail.'/'.$fileNameToStore);

        // resize the image to a width of 300 and height of 200 and constrain aspect ratio (auto height)
        /*$img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPathThumbnail.'/'.$fileNameToStore);*/

        return true;
    }
}