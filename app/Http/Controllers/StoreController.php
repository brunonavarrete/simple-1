<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\Repositories\BaseRepository;

class StoreController extends Controller
{
    /**
     *
     * CRUD
     *
     */
    public function index()
    {
        return Store::get();
    }

    public function store(Request $request)
    {
        $store = new Store;
        return [
            'success' => true,
            'items' => $this->editStore($store,$request)
        ];
    }

    public function show($id)
    {
        return Store::find($id);
    }

    public function update(Request $request, $id)
    {
        $store = Store::find($id);
        return [
            'success' => true,
            'items' => $this->editStore($store,$request)
        ];
    }

    public function destroy($id)
    {
        $store = Store::find($id);
        $store->delete();

        $repo = new BaseRepository;
        return [
            'success' => true,
            'items' => $repo->getAppData($store->owner_id)
        ];
    }

    public function editStore($store,$request)
    {
        $store->name = $request->name;
        $store->owner_id = $request->owner_id;
        $store->opens_at = $request->opens_at;
        $store->closes_at = $request->closes_at;

        $store->save();

        $repo = new BaseRepository;
        return $repo->getAppData($store->owner_id, $request->selected_date);
    }
}
