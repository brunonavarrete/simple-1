<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Repositories\BaseRepository;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Service::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $service = new Service;
        return [
            'success' => true,
            'items' => $this->editService($service,$request)
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
        //
    }

    /**
     * Display the specified resource by owner.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showByOwner($owner_id)
    {
        return Service::where('owner_id',$owner_id)
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
        $service = Service::find($id);
        return [
            'success' => true,
            'items' => $this->editService($service,$request)
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
        $service = Service::find($id);
        $service->delete();
        
        $repo = new BaseRepository;
        return [
            'success' => true,
            'items' => $repo->getAppData($service->owner_id)
        ];
    }

    public function editService($service,$request)
    {
        $service->name = $request->name;
        $service->owner_id = $request->owner_id;
        $service->cost = $request->cost;

        $service->save();

        $repo = new BaseRepository;
        return $repo->getAppData($service->owner_id);
    }
}
