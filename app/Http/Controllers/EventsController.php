<?php

namespace App\Http\Controllers;

use App\Http\Requests\ajaxPriceRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\Record;
use Illuminate\Support\Facades\Validator;

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
     * @param ajaxPriceRequest|Request $request
     * @return \Illuminate\Http\Response
     * @internal param Event $event
     * @internal param Event $event
     */
    public function store(ajaxPriceRequest $request)
    {
        Event::create($request->all());
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
     * @param Event $event
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Event $event)
    {
        return view('events.edit', [
            'event' => $event
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Event $event
     * @param Record $record
     * @return \Illuminate\Http\RedirectResponse
     * @internal param int $id
     */
    public function update(Request $request, Event $event, Record $record)
    {
        $diff = Carbon::now()->diffInMinutes($event->created_at);
        $validator = Validator::make($request->all(), [
            'duration' => 'required|numeric|min:' . ($diff + 1),
            'description' => 'sometimes|required'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $event->update($request->all());

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
}
