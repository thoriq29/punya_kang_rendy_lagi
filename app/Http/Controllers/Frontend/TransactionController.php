<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\Datatables\Datatables;
use App\User;
use App\Payment;
use App\Order;
use Session;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $orders = Order::with('customer', 'package')->where('customer_id', \Auth::user()->id);

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
                        'show_url'        => route('transaction.show', $order->id),
                        'cancel_url'        => route('transaction.cancel', $order->id),
                        'confirm_url'        => route('transaction.edit', $order)
                    ]);
                })
                ->escapeColumns([])
                ->make(true);
        }

        return view('frontend.transactions.index');
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

        if ($order == null || $order->customer_id != \Auth::user()->id){
            Session::flash("flash_notification", [
                "level" => "error",
                "message" => "Data transaksi tidak tersedia!"
            ]);
            return back();
        }

        $sum_paid = Payment::where('order_id',$order->id)->where('is_verification', 1)->sum('paid');

        $paid_data = [
            "price" => $order->price_total,
            "paid_off" => $sum_paid,
            "paid_remain" => ($order->price_total) - $sum_paid
        ];

        return view('frontend.transactions.show')->with(compact('order', 'paid_data'));

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

        if ($order == null || $order->customer_id != \Auth::user()->id){
            Session::flash("flash_notification", [
                "level" => "error",
                "message" => "Data transaksi tidak tersedia!"
            ]);
            return back();
        }

        $sum_paid = Payment::where('order_id',$order->id)->where('is_verification', 1)->sum('paid');

        $paid_data = [
            "price" => $order->price_total,
            "paid_off" => $sum_paid,
            "paid_remain" => ($order->price_total) - $sum_paid
        ];

        return view('frontend.transactions.edit')->with(compact('order', 'paid_data'));

    }

    public function cancel($id)
    {
        $order = Order::find($id);
        $order->status = 10;
        $order->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Order berhasil dibatalkan!"
        ]);
        return back();
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
            'method' => 'required|string',
            'account_holder' => 'required|string|max:255',
            'paid' => 'required|numeric',
            'image' => 'required|image',
        ]);

        $payment = new Payment;
        $payment->order_id = $id;
        $payment->method = $request->method;
        $payment->account_holder = $request->account_holder;
        $payment->paid = $request->paid;

        if ($request->hasFile('image')) {
            // megnambil image yang diupload berikut ekstensinya
            $filename = null;
            $uploaded_image = $request->file('image');
            $extension = $uploaded_image->getClientOriginalExtension();
            // membuat nama file random dengan extension
            $filename = uniqid() . '.' . $extension;
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'payments';
            // memindahkan file ke folder public/images
            $uploaded_image->move($destinationPath, $filename);

            $payment->image = $filename;
        }
        $payment->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Konfirmasi pembayaran berhasil"
        ]);

        return redirect()->route('transaction.index');
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
