<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $auth = \Auth::user()->role;

        if ($auth == 'admin') {
            return $this->admin();
        } else {
            return $this->member();
        }
    }

    public function admin()
    {
        return view('backend.home');
    }

    public function member()
    {
        return view('frontend.home');
    }
}
