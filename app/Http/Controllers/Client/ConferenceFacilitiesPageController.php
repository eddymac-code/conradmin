<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ConferenceFacility;
use App\Models\Page;
use Illuminate\Http\Request;

class ConferenceFacilitiesPageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    
    public function index()
    {
        $page = Page::where('title', 'Conference Facilities')->first();
        $facilities = ConferenceFacility::all();

        return view('client.conferences', [
            'page' => $page,
            'facilities' => $facilities
        ]);
    }
}
