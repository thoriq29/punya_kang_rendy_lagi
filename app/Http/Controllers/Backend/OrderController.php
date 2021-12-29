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

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $orders = Order::with('customer', 'package');

            if ($request->get('status') != null) {
                if ($request->status != 'all') {
                    $orders->whereStatus($request->status);
                }
            }

            $orders = $orders->select('orders.*');

            return Datatables::of($orders)
                ->addIndexColumn()
                ->addColumn('action', function ($order) {
                    return view('partials._action', [
                        'model'           => $order,
                        'show_url'        => route('order.show', $order->id),
                        'edit_url'        => route('order.edit', $order->id)
                    ]);
                })
                ->escapeColumns([])
                ->make(true);
        }

        return view('backend.orders.index');
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
        $order = Order::find($id);

        $sum_paid = Payment::where('order_id',$order->id)->where('is_verification', 1)->sum('paid');

        $paid_data = [
            "price" => $order->price_total,
            "paid_off" => $sum_paid,
            "paid_remain" => ($order->price_total) - $sum_paid
        ];

        return view('backend.orders.show')->with(compact('order', 'paid_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);

        $sum_paid = Payment::where('order_id',$order->id)->where('is_verification', 1)->sum('paid');

        $paid_data = [
            "price" => $order->price_total,
            "paid_off" => $sum_paid,
            "paid_remain" => ($order->price_total) - $sum_paid
        ];

        return view('backend.orders.edit')->with(compact('order', 'paid_data'));
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
        $order = Order::find($id);

        if ($request->has('cancel_order')) {
            $order->status = 10;
        }

        if ($request->has('additional_fee')) {
            $order->additional_fee = $request->additional_fee ?? 0;
            $order->price_total = $order->price + ($request->additional_fee ?? 0);
        }

        $order->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Order berhasil diupdate!"
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
