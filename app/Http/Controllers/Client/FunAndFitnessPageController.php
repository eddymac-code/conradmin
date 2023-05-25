<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Gym;
use App\Models\Page;
use App\Models\Pool;
use Illuminate\Http\Request;

class FunAndFitnessPageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    
    public function index()
    {
        $page = Page::where('title', 'Fun and Fitness')->first();
        $gyms = Gym::all();
        $pools = Pool::all();

        return view('client.funfitness', [
            'page' => $page,
            'gyms' => $gyms,
            'pools' => $pools
        ]);
    }
}
