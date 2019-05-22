<?php
/**
 * Created by PhpStorm.
 * User: emadb
 * Date: 30/12/2018
 * Time: 10:49
 */

namespace App\Services;

class UploadFilesServices
{
    /**
     * @param $request
     * @param string $fileName
     * @param string $directory
     * @return string
     */
    public function uploadImage($request, string $fileName, string $directory)
    {
        //handle file upload
        if ($request->hasFile($fileName)) {
            //Get Filename with the extension
            $fileNameWithExt = $request->file($fileName)->getClientOriginalName();
            //get only filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get only exception
            $extension = $request->file($fileName)->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //upload the image
            $path = $request->file($fileName)->storeAs($directory, $fileNameToStore);
        }
        else {
            // Default Url image
            $fileNameToStore = 'noimage.jpg';
        }

        return $fileNameToStore;
    }

}
