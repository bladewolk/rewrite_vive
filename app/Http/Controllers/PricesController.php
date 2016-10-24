<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriceCreate;
use App\Http\Requests\PriceUpdate;
use App\Models\Price;
use Illuminate\Http\Request;
use App\Models\Device;

class PricesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('prices.index', [
            'prices' => Price::withTrashed()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('prices.create', [
            'devices' => Device::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PriceCreate $request
     * @return \Illuminate\Http\Response
     * @internal param Price $price
     */
    public function store(PriceCreate $request)
    {
        Price::create($request->all());
        return redirect()->route('prices.index');
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
     * @param Price $price
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Price $price)
    {
        return view('prices.edit', [
            'price' => $price
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PriceUpdate $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Price $price
     * @internal param int $id
     */
    public function update(PriceUpdate $request, $id)
    {
        if ($request->action === 'Restore') {
            Price::withTrashed()->find($id)->restore();
        } else {
            Price::find($id)->update($request->all());
        }

        return redirect()->route('prices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Price $price
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Price $price)
    {
        $price->delete();
        return redirect()->route('prices.index');
    }
}
