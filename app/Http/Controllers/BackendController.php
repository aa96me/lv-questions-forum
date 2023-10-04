<?php
/*
|--------------------------------------------------------------------------
| Created by www.aa96.me ~ AbdulKader Aliwi
| eng.aliwi@gmail.com
|--------------------------------------------------------------------------
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Setting;
use Auth;
use Hash;
use Artisan;

class BackendController extends Controller
{
    public function admin_dashboard()
    {
        if(Auth::check()&&Auth::user()->id == 1){
            return view('backend.dashboard');
        }else abort(404);
    }

    //Profile
    public function admin_profile()
    {
        return view('backend.admin_profile');
    }

    public function admin_profile_update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->new_password != null && ($request->new_password == $request->confirm_password)){
            $user->password = Hash::make($request->new_password);
        }
        if($user->save()){
            flash('Your profile has been updated successfully')->success();
            return back();
        }
        flash('Sorry, There is something wrong')->error();
        return back();
    }

    //User
    public function admin_users_index(Request $request)
    {
        $users = User::orderBy('created_at', 'desc');
        $users = $users->paginate(15);
        return view('backend.users_index', compact('users'));
    }

    public function admin_users_delete($id)
    {
        if($id > 1){
            if(User::destroy($id)){
                flash('User deleted successfully')->success();
                return redirect()->route('users.index');
            }
        }
        flash('Something is wrong')->error();
        return back();
    }

    //Settings
    public function setting_index(Request $request)
    {
    	return view('backend.setting_index');
    }

    public function overWriteEnvFile($type, $val)
    {
            $path = base_path('.env');
            if (file_exists($path)) {
                $val = '"'.trim($val).'"';
                if(is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0){
                    file_put_contents($path, str_replace(
                        $type.'="'.env($type).'"', $type.'='.$val, file_get_contents($path)
                    ));
                }
                else{
                    file_put_contents($path, file_get_contents($path)."\r\n".$type.'='.$val);
                }
            }
    }


    public function setting_update(Request $request)
    {
        foreach ($request->types as $key => $type) {
            if($type == 'site_name'){
                $this->overWriteEnvFile('APP_NAME', $request[$type]);
            }
            else {
                $settings = Setting::where('type', $type)->first();
                if($settings!=null){
                    if(gettype($request[$type]) == 'array'){
                        $settings->value = json_encode($request[$type]);
                    }
                    else {
                        $settings->value = $request[$type];
                    }
                    $settings->save();
                }
                else{
                    $settings = new Setting;
                    $settings->type = $type;
                    if(gettype($request[$type]) == 'array'){
                        $settings->value = json_encode($request[$type]);
                    }
                    else {
                        $settings->value = $request[$type];
                    }
                    $settings->save();
                }
            }
        }
        flash("Settings have been updated successfully")->success();
        return back();
    }

    public function setting_maintenance(Request $request)
    {
        $settings = Setting::where('type', $request->type)->first();
        if($settings!=null){
            if ($request->type == 'maintenance_mode' && $request->value == '1') {
                    Artisan::call('down');
            }
            elseif ($request->type == 'maintenance_mode' && $request->value == '0') {
                    Artisan::call('up');
            }
            $settings->value = $request->value;
            $settings->save();
        }
        return '1';
    }
}
