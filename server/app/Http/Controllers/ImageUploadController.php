<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Common\Utils;

class ImageUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUpload()

    {

        return view('components.imageUpload');

    }
    public function imageUploadPost()

    {

        request()->validate([

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);



        $imageName = time().'.'.request()->image->getClientOriginalExtension();

        request()->image->move(Utils::pathUploadImage('images/upload'), $imageName);



        return back()

            ->with('success','You have successfully upload image and please save your change.')

            ->with('image',$imageName);

    }
}
