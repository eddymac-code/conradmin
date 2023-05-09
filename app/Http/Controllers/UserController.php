<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use League\Flysystem\PathNormalizer;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::denies('users.access')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $users = User::all();
        
        return view('users.data', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::denies('users.create')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Gate::denies('users.create')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed'],
            'photo' => ['mimes:jpg,png,webp']
        ]);
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if ($request->hasFile('photo')) {
            $destination = 'public/images/users';
            $photo = $request->file('photo');
            $photo_name = date("YmdHis")."_Photo_".$photo->getClientOriginalName();
            $photo->storeAs($destination, $photo_name);

            $user->image = $photo_name;
        }

        $user->save();

        return redirect()->route('users')->with('message', 'Successfully saved!');

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if (Gate::denies('users.view')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if (Gate::denies('users.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if (Gate::denies('users.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'photo' => ['mimes:jpg,png,webp']
        ]);
        
        $setuser = User::find($user->id);
        $setuser->name = $request->name;
        $setuser->email = $request->email;

        if (!empty($request->password)) {
            $setuser->password = Hash::make($request->password);
        }

        if ($request->hasFile('photo')) {
            $destination = 'public/images/users';
            $photo = $request->file('photo');
            $photo_name = date("YmdHis")."_Photo_".$photo->getClientOriginalName();
            $photo->storeAs($destination, $photo_name);

            $setuser->image = $photo_name;
        }

        $setuser->save();

        return redirect()->route('users')->with('message', 'Successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (Gate::denies('users.delete')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        
        if ($user->id === 1) {
            return redirect()->route('users')->with('message', 'This user is essential to the system!');
        }

        $user->delete();

        return redirect()->route('users')->with('message', 'User Deleted.');
    }
}
