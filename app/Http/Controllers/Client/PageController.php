<?php

namespace App\Http\Controllers\Client;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class PageController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }

    public function index()
    {
        if (Gate::denies('pages.access')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        
        $pages = Page::all(['id','title', 'image']);
        
        return view('pages.data', [
            'pages' => $pages
        ]);
    }
    
    public function create()
    {
        if (Gate::denies('pages.create')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        return view('pages.create');
    }

    public function store(Request $request)
    {
        if (Gate::denies('pages.create')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $this->validate($request, [
            'title' => 'required',
        ]);

        $page = new Page();
        $page->title = $request->title;
        $page->content = $request->content;

        if ($request->hasFile('photo')) {
            $destination = 'public/images/pages';
            $photo = $request->file('photo');
            $photo_name = date("YmdHis")."_Photo_".$photo->getClientOriginalName();
            $photo->storeAs($destination, $photo_name);

            $page->image = $photo_name;
        }

        $page->save();

        return redirect()->route('pages')->with('message', 'Successfully added!');
    }

    public function show($id)
    {
        if (Gate::denies('pages.view')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        
        $page = Page::find($id);

        return view('pages.show', [
            'page' => $page
        ]);
    }

    public function edit($id)
    {
        if (Gate::denies('pages.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        
        $page = Page::find($id);

        return view('pages.edit', [
            'page' => $page
        ]);
    }

    public function update(Request $request, $id)
    {
        if (Gate::denies('pages.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        
        $this->validate($request, [
            'title' => 'required',
        ]);

        $page = Page::find($id);
        $page->title = $request->title;
        $page->content = $request->content;

        if ($request->hasFile('photo')) {
            $destination = 'public/images/pages';
            $photo = $request->file('photo');
            $photo_name = date("YmdHis")."_Photo_".$photo->getClientOriginalName();
            $photo->storeAs($destination, $photo_name);

            $page->image = $photo_name;
        }

        $page->save();

        return redirect()->route('pages')->with('message', 'Successfully updated!');
    }

    public function destroy($id)
    {
        if (Gate::denies('pages.delete')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        
        $page = Page::find($id);
        $page->delete();

        return redirect()->route('pages')->with('message', 'Deleted!');
    }
}
