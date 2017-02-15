<?php

namespace evolunt\Http\Controllers\Auth;

use evolunt\User;
use evolunt\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|unique:users|alpha_dash|max:20',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */


    protected function create(Request $data)
    {
        if($data['image'])
        {
            $imageName = time() . '.' . $data->image->getClientOriginalExtension();
            $data->image->move(public_path('images'), $imageName);

            return User::create([
                'username' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'picture' =>  $imageName,
                'admin' => '0',
                'charity' => '0',
                'description' => NULL,
                'name' => NULL
            ]);
        }
        else {
        return User::create([
            'username' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'admin' => '0',
            'charity' => '0',
            'description' => NULL,
            'name' => NULL
        ]);
        }
    }
}
