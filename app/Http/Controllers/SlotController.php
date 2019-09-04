<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Concept;
use App\Ticket;
use App\Service;
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
                'items' => $this->editSlot($slot,$request,true)
            ];
        }

        public function update(Request $request, $id)
        {
            $slot = Slot::find($id);

            return [
                'success' => true,
                'items' => $this->editSlot($slot,$request,false)
            ];
        }

        public function destroy($id)
        {
            $slot = Slot::find($id);
            $slot->delete();

            // $date = Carbon::today()->toDateString();

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
        public function editSlot($slot,$request,$new)
        {
            $slot->client_id = $request->client;
            $slot->employee_id = $request->employee;
            $slot->service_id = $request->service;
            $slot->date = $request->date;
            $slot->begins_at = $request->begins_at;
            $slot->ends_at = $request->ends_at;
            $slot->status = $request->status;

            $slot->save();

            /* 
             * Create new ticket
             */

            if( $new ) { $this->newTicket($slot); }

            // $date = Carbon::today()->toDateString();
            $employee = User::find( $slot->employee_id );

            $repo = new BaseRepository;
            return $repo->getAppData($employee->owner_id, $request->selected_date);
        }

        public function newTicket($slot)
        {
            $service = Service::find($slot->service_id);

            $ticket = new Ticket;
            $ticket->slot_id = $slot->id;
            $ticket->save();

            $concept = new Concept;
            $concept->ticket_id = $ticket->id;
            $concept->concept = $service['name'];
            $concept->cost = $service['cost'];
            $concept->save();
        }
}
