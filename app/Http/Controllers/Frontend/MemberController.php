<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use App\Member;
use App\User;
use Auth;
use Session;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $urlWithQueryString = $request->fullUrl();
        $returnPath = $request->query('returnPath');
        $user = Auth::user();
        $member = Member::where('user_id',$user->id)->first();

        return view('frontend.members.index')->with(compact('user', 'member', 'returnPath'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'full_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'identity_card' => 'required|digits:16|unique:users',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|string',
            'passport_number' => 'required|numeric',
            'passport_place' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|numeric',
            'email' => 'required|string|max:255',
            'profession' => 'required|string|max:255',
            'is_already_umrah' => 'required|numeric',
            'last_education' => 'required|string|max:255',
            'emergency_name' => 'required|string|max:255',
            'emergency_identity_card' => 'required|digits:16',
            'emergency_phone' => 'required|numeric',
            'emergency_relationship' => 'required|string|max:255',
            'emergency_address' => 'required|string',
            //'image' => 'required|image',
        ]);

        $user = Auth::user();

        $member = Member::firstOrNew(['user_id' => $user->id]);

        $member->full_name = $request->full_name;
        $member->father_name = $request->father_name;
        $member->identity_card = $request->identity_card;
        $member->birth_place = $request->birth_place;
        $member->birth_date = $request->birth_date;
        $member->passport_number = $request->passport_number;
        $member->passport_place = $request->passport_place;
        $member->address = $request->address;
        $member->phone = $request->phone;
        $member->email = $request->email;
        $member->profession = $request->profession;
        $member->is_already_umrah = $request->is_already_umrah;
        $member->last_education = $request->last_education;
        $member->emergency_name = $request->emergency_name;
        $member->emergency_identity_card = $request->emergency_identity_card;
        $member->emergency_phone = $request->emergency_phone;
        $member->emergency_relationship = $request->emergency_relationship;
        $member->emergency_address = $request->emergency_address;

        if ($request->hasFile('image')) {
            // megnambil image yang diupload berikut ekstensinya
            $filename = null;
            $uploaded_image = $request->file('image');
            $extension = $uploaded_image->getClientOriginalExtension();
            // membuat nama file random dengan extension
            $filename = uniqid() . '.' . $extension;
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'members';
            // memindahkan file ke folder public/images
            $uploaded_image->move($destinationPath, $filename);

            $member->image = $filename;
        }

        $member->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Data Jama'ah berhasil diperbaharui"
        ]);

        if( $request->has('returnPath') ) {
            $path = $request->query('returnPath'); 
            return Redirect::to($path);
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
