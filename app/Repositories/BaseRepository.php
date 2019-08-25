<?php

namespace App\Repositories;

use App\User;
use App\Service;
use App\Store;

class BaseRepository
{
    public function getAppData($owner_id)
    {
        $users = User::where('owner_id',$owner_id)
            ->with([
				'store',
				'slots',
				'slots.client',
				'slots.service',
				'slots.employee'
            ])
            ->get();

        $services = Service::where('owner_id',$owner_id)
            ->get();

        $stores = Store::where('owner_id',$owner_id)
            ->get();

        foreach ($users as $user) {
            // Mutators on User returns only today's
            $user->todays_slots = true; 
            $user->full_name = true;
        }

        return [
            'users' => $users,
            'services' => $services,
            'stores' => $stores
        ];
    }
}