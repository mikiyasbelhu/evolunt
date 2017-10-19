<?php

namespace evolunt\Http\Controllers\Auth;

use evolunt\User;
use evolunt\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Socialite;

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
            'username' => 'required|unique:users|alpha_dash|max:20',
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
                'name' => NULL,
                'description' => NULL,
                'admin' => '0',
                'charity' => '0'

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

    /**
 * Redirect the user to the GitHub authentication page.
 *
 * @return Response
 */
public function redirectToProvider()
{
    return Socialite::driver('facebook')->redirect();
}

/**
 * Obtain the user information from GitHub.
 *
 * @return Response
 */
public function handleProviderCallback()
{
    //$user = Socialite::driver('facebook')->user();
  //  $user = Socialite::with('facebook')->user();
  $user = Socialite::driver('facebook')->user();

  $userModel = User::firstOrNew(['email' => $user->getEmail()]);
  if (!$userModel->id) {
      $userModel->fill([email=>getEmail()]);//Fill the user model with your data
      $userModel->save();
  }

  Auth::login($userModel);

  return redirect('my-profile')
          ->with('message', 'You have signed in with Facebook.');
//    return $user->getEmail();
}
}
