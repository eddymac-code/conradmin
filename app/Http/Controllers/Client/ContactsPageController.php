<?php

namespace App\Http\Controllers\Client;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactsPageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    
    public function index()
    {
        $page = Page::where('title', 'Contact Us')->first();
        return view('client.contacts', [
            'page' => $page
        ]);
    }
}
