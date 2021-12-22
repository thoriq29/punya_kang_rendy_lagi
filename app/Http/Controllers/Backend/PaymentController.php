<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\Datatables\Datatables;
use App\User;
use App\Package;
use App\Order;
use App\Payment;
use Session;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $payments = Payment::with('order');

            if ($request->get('verification') != null) {
                if ($request->verification != 'all') {
                    $payments->whereIsVerification($request->verification);
                }
            }

            $payments = $payments->select('payments.*');

            return Datatables::of($payments)
                ->addIndexColumn()
                ->addColumn('action', function ($payment) {
                    return view('partials._action', [
                        'model'           => $payment,
                        'show_url'        => route('payment.show', $payment->id)
                    ]);
                })
                ->escapeColumns([])
                ->make(true);
        }

        return view('backend.payments.index');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = Payment::find($id);

        return view('backend.payments.show')->with(compact('payment'));
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
        $payment = Payment::find($id);
        $order = Order::find($payment->order_id);
        
        $count_payment = Payment::where('order_id',$payment->order_id)->count();
        
        if ($order->payment_type == "parsial" && $count_payment == 1) {
            $payment->is_down_payment = 1;
        }

        $payment->is_verification = 1;
        $payment->payment_count = $count_payment - 1;
        $payment->save();

        $status = 210;
        $paid_off = 1;
        $sum_paid = Payment::where('order_id',$order->id)->where('is_verification', 1)->sum('paid');
        if ($order->payment_type == "parsial") {
            if ($sum_paid >= $order->price_total) {
                $status = 210;
                $paid_off = 1;
            } else {
                $status = 200;
                $paid_off = 0;
            }
        }
        
        $order->status = $status;
        $order->has_paid_off = $paid_off;
        $order->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Pembayaran berhasil diverifikasi!"
        ]);

        return back();
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
