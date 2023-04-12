<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;

class UploadController extends Controller
{
    public function add(Request $request){
        $validated = $request->validate([
            'name'=> 'required|string',
            'image'=> 'required|image'
        ]);
        $imageName = time() . '.' . $request->image->extension();
        $imagePath = "images/" . $imageName;
        $request->image->move(public_path('images'), $imageName);
        $upload = Upload::create(array_merge($validated,[
            'image'=>$imagePath
        ]));
        return response()->json([
            'upload'=> $upload
        ],201);
    }
}
