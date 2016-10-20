<?php

namespace App\Http\Controllers;

use App\Http\Requests\AjaxPriceRequest;
use App\Models\Device;
use App\Models\Event;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
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
            'events' => Event::with('records')->latest()->paginate(4)
        ]);
    }

    public function ajaxPrice(AjaxPriceRequest $request, Event $event)
    {
        return $event->fill($request->all())->total_price;
    }

    public function ajaxCancel(Event $event)
    {
        $event->update([
            'status' => Event::STATUS_CANCELED
        ]);
    }

}
