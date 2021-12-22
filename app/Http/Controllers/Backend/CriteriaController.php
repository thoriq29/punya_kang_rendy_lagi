<?php

namespace App\Http\Controllers\Backend;

use App\AlternativeCriteria;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\Datatables\Datatables;
use App\User;
use App\Criteria;
use Session;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $criterias = Criteria::query();
            $criterias = $criterias->select('criteria.*');

            return Datatables::of($criterias)
                ->addIndexColumn()
                ->addColumn('action', function ($criteria) {
                    return view('partials._action', [
                        'model'           => $criteria,
                        // dikomen
                        // 'form_url'        => route('criteria.destroy', $criteria->id),
                        'edit_url'        => route('criteria.edit', $criteria->id)
                    ]);
                })
                ->escapeColumns([])
                ->make(true);
        }

        return view('backend.criteria.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.criteria.create');
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
            'weight' => 'required|numeric',
        ]);

        $criteria = new Criteria;
        $criteria->name = $request->name;
        $criteria->weight = $request->weight;
        $criteria->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Kriteria berhasil dibuat"
        ]);

        return redirect()->route('criteria.index');
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
        $criteria = Criteria::find($id);

        return view('backend.criteria.edit')->with(compact('criteria'));
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
            'weight' => 'required|numeric',
        ]);

        $criteria = Criteria::find($id);
        $criteria->name = $request->name;
        $criteria->weight = $request->weight;
        $criteria->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Kriteria berhasil diubah"
        ]);

        return redirect()->route('criteria.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $criteria = Criteria::find($id);

        $check = AlternativeCriteria::where('criteria_id', $id)->count();

        if ($check > 0) {
            Session::flash("flash_notification", [
                "level" => "warning",
                "message" => "Tidak dapat menghapus kriteria ini, karena kriteria ini memiliki data relasi pada alternatif kriteria."
            ]);
            return redirect()->back();
        }

        $criteria->delete();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menghapus data"
        ]);

        return redirect()->route('criteria.index');
    }
}
