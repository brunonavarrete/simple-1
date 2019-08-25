<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BaseRepository;

class HomeController extends Controller
{
    public function getAppData(BaseRepository $repo, $owner_id)
    {
        return [
        	'success' => true,
        	'items' => (array) $repo->getAppData($owner_id)
        ];
    }
}
