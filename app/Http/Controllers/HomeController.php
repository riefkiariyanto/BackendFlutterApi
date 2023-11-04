<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\BiodataShop;
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
        $idClient = Auth::guard('client')->user()->id;

        $biodata = BiodataShop::where('id_clients', $idClient)->get();

        if( count($biodata) > 0 ) {
            return view('client.dashboard');
        }else{
            return view('client.formProfile');
        }
    }
}
