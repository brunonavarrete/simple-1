<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slot;
use App\Station;
use Carbon\Carbon;

class SlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Slot::get();
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
        $slot = new Slot;

        return [
            'success' => true,
            'slots' => $this->editSlot($slot,$request)
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
        return Slot::find($id);
    }

    /**
     * Display the specified resource by date.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showByDate($store_id, $date)
    {
        return Slot::where('store_id', $store_id)
                    ->where('date',$date)
                    ->with(['employee','client','service'])
                    ->get();
    }

    /**
     * Display the specified resource by date.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showByEmployee($employee_id, $date)
    {
        return Slot::where('employee_id', $employee_id) 
                    ->where('date',$date)
                    ->with([
                        'employee',
                        'client',
                        'service'
                    ])
                    ->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $slot = Slot::find($id);

        return [
            'success' => true,
            'slots' => $this->editSlot($slot,$request)
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
        $slot = Slot::find($id);
        $slot->delete();

        $date = Carbon::today()->toDateString();
        $days_slots = $this->showByDate($slot->store_id,$date);

        return ['success' => true,'slots' => $days_slots];
    }

    public function editSlot($slot,$request)
    {
        $slot->client_id = $request->client_id;
        $slot->employee_id = $request->employee_id;
        $slot->store_id = $request->store_id;
        $slot->service_id = $request->service_id;
        $slot->date = $request->date;
        $slot->begins_at = $request->begins_at;
        $slot->ends_at = $request->ends_at;

        $slot->save();

        $date = Carbon::today()->toDateString();

        return $this->showByDate($slot->store_id,$date);
    }

}
