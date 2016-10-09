<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Devices;
use App\Prices;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Devices::all();
        return view('pages.index', compact('data'));
    }

    public function ajaxPrice(Request $request)
    {
        $price = Prices::findOrFail($request->radio);
        $price = $request->numb * ($price->price / $price->minTime);
        return round($price, 1, 0);
    }

    public function create()
    {
        return null;
    }
}
