<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SettingController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }
    
    public function index()
    {
        if (Gate::denies('settings.access')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }
        
        $data = Setting::all();

        return view('setting.data', [
            'data' => $data
        ]);
    }

    public function update(Request $request)
    {   
        if (Gate::denies('settings.update')) {
            return redirect()->route('home')->with('message', 'Permission denied! Contact System Administrator.');
        }

        Setting::where('setting_key', 'hotel_name')->update(['setting_value' => $request->hotel_name]);
        Setting::where('setting_key', 'hotel_address')->update(['setting_value' => $request->hotel_address]);
        Setting::where('setting_key', 'hotel_country')->update(['setting_value' => $request->hotel_country]);
        Setting::where('setting_key', 'hotel_city')->update(['setting_value' => $request->hotel_city]);
        Setting::where('setting_key', 'hotel_zip')->update(['setting_value' => $request->hotel_zip]);
        Setting::where('setting_key', 'hotel_email')->update(['setting_value' => $request->hotel_email]);
        Setting::where('setting_key', 'hotel_website')->update(['setting_value' => $request->hotel_website]);
        Setting::where('setting_key', 'hotel_pin')->update(['setting_value' => $request->hotel_pin]);
        Setting::where('setting_key', 'hotel_currency')->update(['setting_value' => $request->hotel_currency]);
        Setting::where('setting_key', 'currency_symbol')->update(['setting_value' => $request->currency_symbol]);
        Setting::where('setting_key', 'currency_position')->update(['setting_value' => $request->currency_position]);

        if ($request->hasFile('hotel_logo')) {
            $destination_path = 'public/images/general';
            $photo = $request->file('hotel_logo');
            $photo_name = $photo->getClientOriginalName();
            $request->file('hotel_logo')->storeAs($destination_path, $photo_name);

            Setting::where('setting_key', 'hotel_logo')->update(['setting_value' => $photo_name]);
        }

        return redirect()->back()->with('message', 'Settings Updated Successfully!');
    }
}
