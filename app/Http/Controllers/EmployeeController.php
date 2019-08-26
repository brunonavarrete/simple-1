<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class EmployeeController extends Controller
{
    public function toggle($id)
    {
    	$employee = User::find($id);
    	$employee->active = !$employee->active;
    	$employee->save();

    	$employees = User::where('type','employee')
    		->with([
				'store',
				'slots',
				'slots.client',
				'slots.service',
				'slots.employee'
            ])
            ->get();

		foreach ($employees as $e) {
            // Mutators on User returns only today's
            $e->todays_slots = true; 
            $e->full_name = true;
        }

    	return [
    		'success' => true,
    		'employees' => $employees
    	];
    }
}
