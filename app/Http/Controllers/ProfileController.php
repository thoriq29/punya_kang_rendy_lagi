<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Company;
use Session;

class ProfileController extends Controller
{
    public function show()
    {
        $user = \Auth::user();

        if ($user->role == 'admin') {
            return view('backend.users.profile', ['user' => $user]);
        } else {
            return view('frontend.accounts.profile')->with(compact('user'));
        }
    }

    public function update(Request $request)
    {
        $id = \Auth::user()->id;
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users,email,' . $id,
            'identity_card' => 'required|digits:16|unique:users,identity_card,' . $id,
            'phone' => 'required|numeric',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->identity_card = $request->identity_card;
        $user->phone = $request->phone;

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
            "message" => "Profil berhasil diubah"
        ]);

        return redirect()->route('profile.show');
    }

    public function updateMember(Request $request)
    {
        $id = \Auth::user()->id;
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users,email,' . $id,
            'identity_card' => 'required|digits:16|unique:users,identity_card,' . $id,
            'company_name' => 'required|string|max:255',
            'company_description' => 'required|string',
            'company_location' => 'required|string|max:255',
            'company_bank_name' => 'required|string|max:255',
            'company_bank_account' => 'required|string|max:255',
            'company_bank_number' => 'required|numeric',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->identity_card = $request->identity_card;
        $user->phone = $request->phone;

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

        $company = Company::where('owner_id', $id)->first();
        $company->name = $request->company_name;
        $company->description = $request->company_description;
        $company->location = $request->company_location;
        $company->bank_name = $request->company_bank_name;
        $company->bank_account = $request->company_bank_account;
        $company->bank_number = $request->company_bank_number;

        if ($request->hasFile('image')) {
            // megnambil image yang diupload berikut ekstensinya
            $filename = null;
            $uploaded_image = $request->file('image');
            $extension = $uploaded_image->getClientOriginalExtension();
            // membuat nama file random dengan extension
            $filename = uniqid() . '.' . $extension;
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'company';
            // memindahkan file ke folder public/images
            $uploaded_image->move($destinationPath, $filename);
            // hapus image lama, jika ada
            if ($user->image) {
                $old_image = $user->image;
                $filepath = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'company'
                    . DIRECTORY_SEPARATOR . $user->image;
                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                    // File sudah dihapus/tidak ada
                }
            }
            // ganti field image dengan image yang baru
            $company->image = $filename;
        }
        $company->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Informasi akun berhasil diubah"
        ]);

        return redirect()->route('profile.show');
    }
}
