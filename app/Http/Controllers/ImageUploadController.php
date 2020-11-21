<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageUploadController extends Controller
{
    public function fileStore(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $filenameWithoutExten = pathinfo($imageName, PATHINFO_FILENAME);
        $image = Image::make($image)->fit(1200);
        Storage::disk('public')->put("images/articles/".$imageName, (string) $image->encode());
        Storage::disk('public')->put("images/articles/" .$filenameWithoutExten . ".webp", (string) $image->encode('webp', 30));

        return response()->json(['success'=>$imageName]);
    }
    public function fileDestroy(Request $request)
    {
        $filename =  $request->get('filename');
        $path=public_path().'/articles/images/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }
}
