<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\Datatables\Datatables;
use App\User;
use App\Criteria;
use App\Package;
use App\AlternativeCriteria;
use Session;

class AlternativeCriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $alt_criterias = AlternativeCriteria::with('alternative', 'criteria');
            $alt_criterias = $alt_criterias->select('alternative_criteria.*');

            return Datatables::of($alt_criterias)
                ->addIndexColumn()
                ->addColumn('action', function ($alt_criteria) {
                    return view('partials._action', [
                        'model'           => $alt_criteria,
                        // 'form_url'        => route('alternative-criteria.destroy', $alt_criteria->id),
                        'update_status_form_url' => true,
                        'form_action'     => route('alternative-criteria.update_status', $alt_criteria->id),
                        'edit_url'        => route('alternative-criteria.edit', $alt_criteria->id),
                        'status'          => $alt_criteria->status
                    ]);
                })
                ->escapeColumns([])
                ->make(true);
        }

        return view('backend.alternative-criteria.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $packages = Package::where('status', 100)->get();
        $criterias = Criteria::all();

        return view('backend.alternative-criteria.create')->with(compact('packages', 'criterias'));
    }

    public function update_status($id)
    {
        $alt_criteria = AlternativeCriteria::find($id);
        if($alt_criteria->status == 1) {
            $alt_criteria->status = 0;
        } else {
            $alt_criteria->status = 1;
        }

        $alt_criteria->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil mengubah data"
        ]);

        return redirect()->route('alternative-criteria.index');
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
            'alternative_id' => 'required|numeric',
            'criteria_id' => 'required|numeric',
            'score' => 'required|numeric',
        ]);

        $check = AlternativeCriteria::where('alternative_id', $request->alternative_id)->where('criteria_id', $request->criteria_id)->count();
        if ($check > 0) {
            return back()
            ->withInput($request->input())
            ->withErrors([
                'data_exist' => 'Data alternatif dan kriteria tersebut telah diinput sebelumnya!'
            ]);
        }

        $alt_criteria = new AlternativeCriteria;
        $alt_criteria->alternative_id = $request->alternative_id;
        $alt_criteria->criteria_id = $request->criteria_id;
        $alt_criteria->score = $request->score;
        $alt_criteria->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Alternatif Kriteria berhasil dibuat"
        ]);

        return redirect()->route('alternative-criteria.index');
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
        $alt_criteria = AlternativeCriteria::find($id);
        $packages = Package::where('status', 100)->get();
        $criterias = Criteria::all();

        return view('backend.alternative-criteria.edit')->with(compact('alt_criteria','packages', 'criterias'));
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
            'alternative_id' => 'required|numeric',
            'criteria_id' => 'required|numeric',
            'score' => 'required|numeric',
        ]);

        $alt_criteria = AlternativeCriteria::find($id);
        $alt_criteria->alternative_id = $request->alternative_id;
        $alt_criteria->criteria_id = $request->criteria_id;
        $alt_criteria->score = $request->score;
        $alt_criteria->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Alternatif Kriteria berhasil diubah"
        ]);

        return redirect()->route('alternative-criteria.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AlternativeCriteria::destroy($id);

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menghapus data"
        ]);

        return redirect()->route('alternative-criteria.index');
    }
}
