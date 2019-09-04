<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Concept;
use App\Ticket;
use App\Slot;
use App\User;
use App\Repositories\BaseRepository;

class ConceptController extends Controller
{
    /**
     * 
     * CRUD
     * 
     */
        public function index()
        {
            return Concept::get();
        }

        public function show($id)
        {
            return Concept::find($id);
        }

        public function store(Request $request)
        {
            $concept = new Concept;
            $obj = $this->editConcept($concept,$request);

            return [
                'success' => true,
                'items' => $obj['items'],
                'slot' => $obj['slot']
            ];
        }

        public function update(Request $request, $id)
        {
            $concept = Concept::find($id);
            $obj = $this->editConcept($concept,$request);

            return [
                'success' => true,
                'items' => $obj['items'],
                'slot' => $obj['slot']
            ];
        }

        public function destroy($id)
        {
            $slot = Concept::find($id);
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
        public function editConcept($concept,$request)
        {
            $concept->ticket_id = $request->ticket_id;
            $concept->concept = $request->concept;
            $concept->cost = $request->cost;
            
            $concept->save();

            $ticket = Ticket::find( $concept->ticket_id );
            $slot = Slot::with([
                'ticket',
                'ticket.concepts'
            ])
            ->find( $ticket->slot_id );
            $employee = User::find( $slot->employee_id );

            $repo = new BaseRepository;
            return [
                'slot' => $slot,
                'items' => $repo->getAppData($employee->owner_id, $request->selected_date)
            ];
        }
}
