<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\Datatables\Datatables;
use App\AlternativeCriteria;
use App\User;
use App\Package;
use App\Order;
use Session;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $packages = Package::query();

            if ($request->get('status') != null) {
                if ($request->status != 'all') {
                    $packages->whereStatus($request->status);
                }
            }

            $packages = $packages->select('packages.*');

            return Datatables::of($packages)
                ->addIndexColumn()
                ->addColumn('action', function ($package) {
                    return view('partials._action', [
                        'model'           => $package,
                        'form_url'        => route('package.destroy', $package->id),
                        'edit_url'        => route('package.edit', $package->id)
                    ]);
                })
                ->escapeColumns([])
                ->make(true);
        }

        return view('backend.packages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.packages.create');
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
            'description' => 'required|string',
            'quota' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'price' => 'required|numeric',
            'image' => 'required|image',
        ]);

        $package = new Package;
        $package->name = $request->name;
        $package->description = $request->description;
        $package->quota = $request->quota;
        $package->start_date = $request->start_date;
        $package->end_date = $request->end_date;
        $package->price = $request->price;

        if ($request->hasFile('image')) {
            // megnambil image yang diupload berikut ekstensinya
            $filename = null;
            $uploaded_image = $request->file('image');
            $extension = $uploaded_image->getClientOriginalExtension();
            // membuat nama file random dengan extension
            $filename = uniqid() . '.' . $extension;
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'packages';
            // memindahkan file ke folder public/images
            $uploaded_image->move($destinationPath, $filename);

            $package->image = $filename;
        }
        $package->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Paket berhasil dibuat"
        ]);

        return redirect()->route('package.index');
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
        $package = Package::find($id);

        return view('backend.packages.edit')->with(compact('package'));
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
            'description' => 'required|string',
            'quota' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'price' => 'required|numeric',
            'status' => 'required|numeric'
        ]);

        $package = Package::find($id);
        $package->name = $request->name;
        $package->description = $request->description;
        $package->quota = $request->quota;
        $package->start_date = $request->start_date;
        $package->end_date = $request->end_date;
        $package->price = $request->price;
        $package->status = $request->status;

        if ($request->hasFile('image')) {
            // megnambil image yang diupload berikut ekstensinya
            $filename = null;
            $uploaded_image = $request->file('image');
            $extension = $uploaded_image->getClientOriginalExtension();
            // membuat nama file random dengan extension
            $filename = uniqid() . '.' . $extension;
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'packages';
            // memindahkan file ke folder public/images
            $uploaded_image->move($destinationPath, $filename);

            $package->image = $filename;
        }
        $package->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Paket berhasil diubah"
        ]);

        return redirect()->route('package.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = Package::find($id);

        // check booking
        $check_booking = Order::where('package_id', $id)->count();
        if ($check_booking > 0) {
            Session::flash("flash_notification", [
                "level" => "warning",
                "message" => "Tidak dapat menghapus paket ini, karena paket ini telah memiliki data order. Alternatif anda dapat menonaktifkannya"
            ]);
            return redirect()->back();
        }

        $check = AlternativeCriteria::where('alternative_id', $id)->count();

        if ($check > 0) {
            Session::flash("flash_notification", [
                "level" => "warning",
                "message" => "Tidak dapat menghapus paket ini, karena paket ini memiliki data relasi pada alternatif kriteria. Alternatif anda dapat menonaktifkannya"
            ]);
            return redirect()->back();
        }

        if ($package->image) {
            $filepath = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'packages'
                . DIRECTORY_SEPARATOR . $package->image;
            try {
                File::delete($filepath);
            } catch (FileNotFoundException $e) {
                // File sudah dihapus/tidak ada
            }
        }

        $package->delete();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menghapus data"
        ]);

        return redirect()->route('package.index');
    }
}
