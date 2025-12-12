<?php

namespace App\Traits;

use File;
use Storage;

trait UploadTrait
{
    public function uploadfile($id, $file, $path, $model, $fieldname)
    {
        // Creating Path
        $pathone = public_path() . $path;
        if (!File::isDirectory($pathone)) {
            File::makeDirectory($pathone, $mode = 0777, true, true);
        }

        if ($id) {
            $existingfilename = $model::find($id)->$fieldname;
            if ($existingfilename) {
                Storage::disk('public')->delete($path . '/' . $existingfilename);
            }
        }
        $newfilename = time() . '_' . $fieldname . '.' . $file->extension();
        $file->storeAs($path, $newfilename, 'public');
        return $newfilename;
    }
}
