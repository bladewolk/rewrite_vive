<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeviceRequest;
use Illuminate\Http\Request;
use App\Models\Device;

class DevicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('devices.index', [
            'devices' => Device::withTrashed()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('devices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeviceRequest $request, Device $device)
    {
        $device->fill($request->all())->save();
        return redirect()->route('devices.index');
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
     * @param Device $device
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Device $device)
    {
        return view('devices.edit', [
            'device' => $device
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
        if ($request->action === 'Restore') {
            Device::withTrashed()->find($id)->restore();
        } else {
            Device::find($id)->update($request->all());
        }

        return redirect()->route('devices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Device $device
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Device $device)
    {
        $device->delete();
        return redirect()->route('devices.index');
    }
}
