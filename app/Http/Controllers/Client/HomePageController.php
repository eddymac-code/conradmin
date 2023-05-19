<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    
    public function index()
    {
        $page = Page::where('title', 'Overview')->first();

        return view('client.welcome', [
            'page' => $page
        ]);
    }
}
