<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Service;
use App\Store;
use App\Repositories\BaseRepository;

class UserController extends Controller
{
    /**
     *
     * CRUD
     *
     */
        public function index()
        {
            return User::get();
        }

        public function store(Request $request)
        {
            $user = new User;
            return [
                'success' => true,
                'items' => $this->editUser($request,$user)
            ];
        }

        public function show($id)
        {
            return User::with('stores')
                        ->find($id);
        }

        public function update(Request $request, $id)
        {
            $user = User::find($id);
            return [
                'success' => true,
                'items' => $this->editUser($request,$user)
            ];
        }

        public function destroy(BaseRepository $repo, $id)
        {
            $user = User::find($id);
            $user->delete();

            $repo = new BaseRepository;
            return [
                'success' => true,
                'items' => $repo->getAppData($user->owner_id)
            ];
        }

    /**
     *
     * Helpers
     *
     */

        public function editUser($request,$user)
        {
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->type = $request->type;
            $user->owner_id = $request->owner_id;
            $user->store_id = $request->store_id;

            $user->save();

            $repo = new BaseRepository;
            return $repo->getAppData($user->owner_id, $request->selected_date);
        }
}
