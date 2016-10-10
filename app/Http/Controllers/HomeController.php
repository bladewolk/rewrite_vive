<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Event;

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
        return view('pages.index', [
            'devices' => Device::all(),
            'events' => Event::latest()->paginate(4)
        ]);
    }

    public function ajaxPrice(Request $request)
    {
        return (new Event($request->all()))->calculatePrice();
    }

    public function ajaxCancel(Event $event)
    {
        $event->update([
            'status' => Event::STATUS_CANCELED
        ]);
    }

}
