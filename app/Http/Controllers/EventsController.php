<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use App\Models\Record;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request $request
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Event $event)
    {
        $event->fill($request->all());
        $event->user_id = Auth::user()->id;
        $event->total_price = $event->calculatePrice();
        $event->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('events.edit', [
            'event' => Event::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // if edit mode
        if ($request->mode == 'edit') {
            $event = Event::find($id);
            $new_price = DB::table('prices')
                ->where('device_id', '=', $event->device_id)
                ->where('minTime', '<=', $event->duration + $request->duration)
                ->orderBy('created_at', 'desc')
                ->orderBy('minTime', 'desc')
                ->first();
            $new_price = ceil($new_price->value * ($event->duration + $request->duration));

            $event->update([
                'duration' => $event->duration + $request->duration,
                'total_price' => $new_price
            ]);

            $record = new Record($request->all());
            $record->event_id = $id;
            $record->user_id = Auth::user()->id;
            $record->status = 'Edited';
            $record->save();
            return redirect()->route('home');
        }
        // if cancel mode

        $event = Event::find($id);
        $new_price = DB::table('prices')
            ->where('device_id', '=', $event->device_id)
            ->where('minTime', '<=', \Carbon\Carbon::now()->diffInMinutes($event->created_at))
            ->orderBy('created_at', 'desc')
            ->orderBy('minTime', 'desc')
            ->first();
        $new_price = ceil($new_price->value * \Carbon\Carbon::now()->diffInMinutes($event->created_at));

        $event->update([
            'duration' => \Carbon\Carbon::now()->diffInMinutes($event->created_at),
            'total_price' => $new_price,
            'status' => 'canceled'
        ]);

        $record = new Record($request->all());
        $record->event_id = $id;
        $record->user_id = Auth::user()->id;
        $record->status = 'Canceled';
        $record->save();
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cancel($id)
    {
        return $id;
    }
}
