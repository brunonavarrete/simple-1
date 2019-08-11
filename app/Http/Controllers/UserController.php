<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        return [
            'success' => true,
            'users' => $this->editUser($request,$user)
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
        return User::with('stores')
                    ->find($id);
    }

    /**
     * Display the specified resource by owner.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showByOwner($owner_id)
    {
        $users = User::where('owner_id',$owner_id)
                    ->get();

        foreach ($users as $user) {
            // Mutator on User returns only today's
            $user->todays_slots = true; 
        }

        return $users;
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
        $user = User::find($id);
        return [
            'success' => true,
            'users' => $this->editUser($request,$user)
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
        $user = User::find($id);
        $user->delete();

        return [
            'success' => true,
            'users' => $this->showByOwner($user->owner_id)
        ];
    }

    public function editUser($request,$user)
    {
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->type = $request->type;
        $user->owner_id = $request->owner_id;

        $user->save();

        return $this->showByOwner($user->owner_id);
    }
}
