<?php

namespace App\Http\Controllers\Client;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OpenAirEventsPageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    
    public function index()
    {
        $page = Page::where('title', 'Open Air Events')->first();
        return view('client.openairevents', [
            'page' => $page
        ]);
    }
}
