<?php
/*
|--------------------------------------------------------------------------
| Created by www.aa96.me ~ AbdulKader Aliwi
| eng.aliwi@gmail.com
|--------------------------------------------------------------------------
 */
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');

    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        }
        return $user;
    }

    public function register(Request $request)
    {

        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            if (User::where('email', $request->email)->first() != null) {
                flash('Your email address is already registered with us');
                return back();
            }
        }

        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        $this->guard()->login($user);

        if ($user->email != null) {
            event(new Registered($user));
            flash('successfully registered')->success();

        }

        return $this->registered($request, $user)
        ?: redirect($this->redirectPath());
    }

    protected function registered(Request $request, $user)
    {
        return redirect()->route('home');
    }
}
