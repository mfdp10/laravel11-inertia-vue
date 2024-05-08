<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait GoogleDriveImageUpload
{
    /**
     * @param Request $request
     * @return $this|false|string
     */
    public function upload(Request $request, $fieldname = 'image', $directory = 'images', $prevAvatar = ""): ?array
    {
        $new = "yes";
        $uploadedImageResponse = [
            "image_name" => "",
            "image_url" => $prevAvatar ? Storage::disk('google')->url($directory . "/" . $prevAvatar) : "",
            "new_image" => $new,
        ];

        //----- try to upload image ------//
        if ($request->hasFile($fieldname) && $request->file($fieldname)->isValid()) {
            if ($request->get("prev_image")) {
                Storage::disk('google')->delete($directory . "/" . $prevAvatar);
                $new = "no";
            }
            $image = $request->file($fieldname);
            $image_uploaded_path = Storage::disk('google')->put($directory, $image);
            $file_name = str_replace($directory . "/", "", $image_uploaded_path);
            $public_link = Storage::disk('google')->url("task-categories/" . $file_name);

            $file_url = str_replace(
                "https://drive.google.com/uc",
                "https://drive.google.com/thumbnail",
                $public_link
            );

            $uploadedImageResponse = [
                "image_name" => $file_name,
                "image_url" => $file_url,
                "new_image" => $new,
            ];
        }
        //----- end try to upload image ------//

        return $uploadedImageResponse;
    }

    public function delete(Request $request, $directory = 'images'): void
    {
        Storage::disk('google')->delete($directory . "/" . $request->image_name);
    }
}
