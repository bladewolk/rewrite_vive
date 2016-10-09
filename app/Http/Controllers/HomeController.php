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
        $price = DB::table('prices')
            ->where('device_id', '=', $request->radio)
            ->where('minTime', '<', $request->numb)
            ->orderBy('created_at', 'desc')
            ->orderBy('minTime', 'desc')
            ->first();
        $totalPrice = $price->price / $price->maxTime * $request->numb;
        return round($totalPrice, 2);
    }

    public function create()
    {
        return null;
    }
}
