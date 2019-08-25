<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slot;
use App\Station;
use App\User;
use Carbon\Carbon;
use App\Repositories\BaseRepository;

class SlotController extends Controller
{
    /**
     * 
     * CRUD
     * 
     */
        public function index()
        {
            return Slot::get();
        }

        public function show($id)
        {
            return Slot::find($id);
        }

        public function store(Request $request)
        {
            $slot = new Slot;

            return [
                'success' => true,
                'items' => $this->editSlot($slot,$request)
            ];
        }

        public function update(Request $request, $id)
        {
            $slot = Slot::find($id);

            return [
                'success' => true,
                'items' => $this->editSlot($slot,$request)
            ];
        }

        public function destroy($id)
        {
            $slot = Slot::find($id);
            $slot->delete();

            $date = Carbon::today()->toDateString();

            $owner = $slot->employee->owner_id;

            $repo = new BaseRepository;
            return [
                'success' => true,
                'items' => $repo->getAppData($owner)
            ];
        }

    /**
     * 
     * Helper functions
     * 
     */

        /**
         * Edit Slot attributes (used in update() and store())
         */
        public function editSlot($slot,$request)
        {
            $slot->client_id = $request->client;
            $slot->employee_id = $request->employee;
            $slot->service_id = $request->service;
            $slot->date = $request->date;
            $slot->begins_at = $request->begins_at;
            $slot->ends_at = $request->ends_at;

            $slot->save();

            $date = Carbon::today()->toDateString();
            $employee = User::find( $slot->employee_id );
            $owner = $employee->owner_id;

            $repo = new BaseRepository;
            return $repo->getAppData($owner);
        }
}
