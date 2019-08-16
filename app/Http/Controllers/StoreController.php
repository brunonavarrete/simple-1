<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Store::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store = new Store;
        return [
            'success' => true,
            'stores' => $this->editStore($store,$request)
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
        return Store::find($id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showByOwner($owner_id)
    {
        return Store::where('owner_id',$owner_id)
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
        $store = Store::find($id);
        return [
            'success' => true,
            'stores' => $this->editStore($store,$request)
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
        $store = Store::find($id);
        $store->delete();

        return [
            'success' => true,
            'stores' => $this->showByOwner($store->owner_id)
        ];
    }

    public function editStore($store,$request)
    {
        $store->name = $request->name;
        $store->owner_id = $request->owner_id;
        $store->opens_at = $request->opens_at;
        $store->closes_at = $request->closes_at;

        $store->save();

        return $this->showByOwner($store->owner_id);
    }
}
