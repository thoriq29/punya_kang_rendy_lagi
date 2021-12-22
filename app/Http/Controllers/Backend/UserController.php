<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use App\User;
use Auth;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::query();
            
            if ($request->get('role') != null) {
                if ($request->role != 'all') {
                    $users->whereRole($request->role);
                }
            }

            $users = $users->select('users.*');
            

            return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($user) {
                    $admin_role = Auth::user()->role;
                    return view('partials._action', [
                        'model'           => $user,
                        // 'form_url'        => route('user.destroy', $user->id),
                        'update_status_user_form_url' => true,
                        'form_action'     => route('user.update_status', $user->id),
                        'edit_url'        => route('user.edit', $user->id),
                        'status'          => $user->status,
                        'role'            => $user->role, 
                        'admin_roles'     => $admin_role
                    ]);
                })
                ->escapeColumns([])
                ->make(true);
        }

        return view('backend.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create');
    }

    public function update_status($id)
    {
        $user = User::find($id);
        if($user->status == 1) {
            $user->status = 0;
        } else {
            $user->status = 1;
        }

        $user->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil mengubah data"
        ]);

        return redirect()->route('user.index');
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'identity_card' => 'required|digits:16|unique:users',
            'phone' => 'required|numeric',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->identity_card = $request->identity_card;
        $user->phone = $request->phone;
        $user->role = $request->role;
        $user->password =  Hash::make($request->password);

        if ($request->hasFile('avatar')) {
            // megnambil image yang diupload berikut ekstensinya
            $filename = null;
            $uploaded_image = $request->file('avatar');
            $extension = $uploaded_image->getClientOriginalExtension();
            // membuat nama file random dengan extension
            $filename = uniqid() . '.' . $extension;
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'avatars';
            // memindahkan file ke folder public/images
            $uploaded_image->move($destinationPath, $filename);
           
            $user->avatar = $filename;
        }
        $user->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Akun dengan nama $user->name berhasil dibuat"
        ]);

        return redirect()->route('user.index');
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
        $user = User::find($id);

        return view('backend.users.edit')->with(compact('user'));
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
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users,email,' . $id,
            'identity_card' => 'required|digits:16|unique:users,identity_card,' . $id,
            'phone' => 'required|numeric',
            'role' => 'required|string',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->identity_card = $request->identity_card;
        $user->phone = $request->phone;
        $user->role = $request->role;

        if ($request->hasFile('avatar')) {
            // megnambil image yang diupload berikut ekstensinya
            $filename = null;
            $uploaded_image = $request->file('avatar');
            $extension = $uploaded_image->getClientOriginalExtension();
            // membuat nama file random dengan extension
            $filename = uniqid() . '.' . $extension;
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'avatars';
            // memindahkan file ke folder public/images
            $uploaded_image->move($destinationPath, $filename);
            // hapus image lama, jika ada
            if ($user->avatar) {
                $old_image = $user->avatar;
                $filepath = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'avatars'
                    . DIRECTORY_SEPARATOR . $user->avatar;
                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                    // File sudah dihapus/tidak ada
                }
            }
            // ganti field image dengan image yang baru
            $user->avatar = $filename;
        }
        $user->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Akun dengan nama $user->name berhasil diubah"
        ]);

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        // check booking
        /* $check_booking = Booking::where('customer_id', $id)->count();
        if ($check_booking > 0) {
            Session::flash("flash_notification", [
                "level" => "warning",
                "message" => "Tidak dapat menghapus akun ini, karena akun ini telah memiliki histori data penyewaan."
            ]);
            return redirect()->back();
        } */

        /* Disabled - because soft deletes 
        if ($user->avatar) {
            $filepath = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'avatars'
            . DIRECTORY_SEPARATOR . $user->avatar;
            try {
                File::delete($filepath);
            } catch (FileNotFoundException $e) {
                // File sudah dihapus/tidak ada
            }
        } */

        $user->delete();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menghapus data"
        ]);

        return redirect()->route('user.index');
    }
}
