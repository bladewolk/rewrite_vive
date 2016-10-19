<?php

namespace App\Http\Controllers;

use App\Http\Requests\ajaxPriceRequest;
use App\Models\Record;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

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
            'events' => Event::with('records')->latest()->paginate(4)
        ]);
    }

    public function ajaxPrice(ajaxPriceRequest $request, Event $event)
    {
        $event->fill($request->all());
        return $event->calculatePrice();
    }

    public function ajaxCancel(Event $event)
    {
        $event->update([
            'status' => Event::STATUS_CANCELED
        ]);
    }

}
