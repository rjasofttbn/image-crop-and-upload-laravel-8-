<?php
  
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Show the application view.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageCrop()
    {
        return view('image-crop');
    }
    /**
     * Submit image upload.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageCropPost(Request $request)
    {
        $data = $request->image;

        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);

        $data = base64_decode($data);
        $image_name = time() . '.png';
        $path = public_path() . "/images/" . $image_name;

        file_put_contents($path, $data);

        return response()->json(['status' => 1, 'message' => "Image uploaded successfully"]);
    }
}