<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Member;
use App\Package;
use Auth;
use Session;

class PageController extends Controller
{
    public function landing(Request $request)
    {
        $packages = Package::where('status', 100);

        $condition = (env('DB_CONNECTION', 'mysql') == 'pgsql') ? 'ilike' : 'like';

        if ($request->get('q') != null) {
            if ($request->q != 'all') {
                $packages->where('name', $condition, '%' . $request->q . '%');
            }
        }

        $packages = $packages->paginate(8);
        $q = $request->q;

        return view('frontend.pages.landing')->with(compact('packages', 'q'));
    }

    public function pageAbout()
    {
        return view('frontend.pages.about');
    }

    public function checkout($id)
    {
        $package = Package::find($id);
        $user = Auth::user();
        $member = Member::where('user_id',$user->id)->first();

        if (!$package){
            abort(404);
        }

        return view('frontend.pages.checkout')->with(compact('package', 'user', 'member'));
    }

    public function checkoutStore(Request $request)
    {
        $this->validate($request, [
            'payment_type' => 'required|string',
        ]);

        $id = $request->package_id;
        $package = Package::find($id);

        $order = new Order;
        $order->invoice = strtoupper(uniqid());
        $order->customer_id = Auth::user()->id;
        $order->package_id = $package->id;
        $order->price = $package->price;
        $order->additional_fee = 0;
        $order->price_total = $package->price;
        $order->payment_type = $request->payment_type;
        $order->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Checkout pesanan berhasil, silahkan melkaukan konfirmasi permbayaran"
        ]);

        return redirect()->route('transaction.index');
    }
}
