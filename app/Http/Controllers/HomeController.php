<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect('/');
    }

    public function getAppData(BaseRepository $repo, Request $request)
    {
        return [
        	'success' => true,
        	'owner_id' => Auth::id(),
        	'items' => $repo->getAppData(Auth::id(), $request->date)
        ];
    }


}
