<?php

namespace App\Http\Controllers;

use App\Http\Traits\AttachFilesTrait;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class SettingController extends Controller
{
    use AttachFilesTrait;
    public function index(){

        $collection = Setting::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });
        return view('pages.setting.index', $setting);
    }

    public function update(Request $request){

        try{
            $info = $request->except('_token', '_method', 'logo');
            foreach ($info as $key=> $value){
                Setting::where('key', $key)->update(['value' => $value]);
            }

            if($request->hasFile('logo')) {
                // Get the old logo name to delete it
                $old_logo = Setting::where('key', 'logo')->first()->value;

                // Delete the old logo file
                if ($old_logo) {
                    $this->deleteFile($old_logo, 'logo');
                }

                $logo = $request->file('logo');
                // Generate a unique, timestamped filename
                $logo_name = time() . '_' . $logo->getClientOriginalName();
                
                // Update the database with the new unique filename
                Setting::where('key', 'logo')->update(['value' => $logo_name]);
                
                // Upload the file using the new unique filename
                $this->uploadFile($request, 'logo', 'logo', $logo_name);
            }


            toastr()->success(trans('messages.success_update'));
            return back();
        }
        catch (\Exception $e){

            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }
}