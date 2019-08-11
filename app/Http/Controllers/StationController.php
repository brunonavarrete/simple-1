<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Station;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Station::get();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $station = new Station;
        return [
            'success' => true,
            'stations' => $this->editStation($station,$request)
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Station::find($id);
    }

    /**
     * Display the specified resource by store.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showByStore($store_id)
    {
        return Station::where('store_id',$store_id)
                        ->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $station = Station::find($id);
        return [
            'success' => true,
            'stations' => $this->editStation($station,$request)
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $station = Station::find($id);
        $station->delete();

        return [
            'success' => true,
            'stations' => $this->showByStore($station->store_id)
        ];
    }

    public function editStation($station,$request)
    {
        $station->name = $request->name;
        $station->store_id = $request->store_id;

        $station->save();

        return $this->showByStore($station->store_id);
    }
}
