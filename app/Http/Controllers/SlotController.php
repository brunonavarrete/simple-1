<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slot;
use App\Station;
use App\User;
use Carbon\Carbon;

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

            return [
                'success' => true,
                'items' => $this->employeesByOwner($owner,$date)
            ];
        }

    /**
     * 
     * Helper functions
     * 
     */

        /**
         * Return employees
         */
        public function employeesByOwner($owner_id, $date)
        {
            $users = User::where('owner_id', $owner_id)
                ->with([
                    'slots',
                    'slots.client',
                    'slots.service',
                    'slots.employee'
                ])
                ->get();

            foreach ($users as $user) {
                // Mutator on User returns only today's
                $user->todays_slots = true; 
            }

            return ['users' => $users];
        }

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

            return $this->employeesByOwner($owner,$date);
        }
}
