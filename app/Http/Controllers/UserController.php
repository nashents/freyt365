<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index');
    }
    public function admin()
    {
        return view('users.admins');
    }


    public function getProfile($id)
    {
        return view('users.profile')->with([
           'id' => $id,
        ]);
    }

    public function profile(Request $request, $id){
        $this->validate($request,[
            'file'=> 'required|image'
        ]);

        if($request->hasFile('file')){
            $image =  $request->file('file');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300,300,function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('/images/uploads/' . $filename));
            $user = Auth::user();
            $user->profile = $filename;
            $user->update();
            Session::flash('success','Profile picture successfully uploaded');
            return redirect()->back();

        }
        else{
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
