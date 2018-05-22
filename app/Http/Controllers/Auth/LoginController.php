<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\User;
### PARA USAR EL MAIL TENGO QUE USAR LOS PLUYING
#use Mail;

/*
use App\order;
use App\Mail\OrderShipped;
use Illuminate\Http\Requiest;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
*/

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the provider authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider and log in the user.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        try{
            $user = Socialite::driver($provider)->user();
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            abort(403, 'Unauthorized action.');
            return redirect()->to('/');
        }

        $passCifrada = bcrypt(str_random(16));

        $attributes = [
            'provider' => $provider,
            'provider_id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => isset($attributes['password']) ? $attributes['password'] : $passCifrada

        ];

        $user = User::where('provider_id', $user->getId() )->first();
        if (!$user){
            try{
                $user=  User::create($attributes);
                # LE ENVIAMOS LA CONTRASEÑA DE LA APLICACION AL USUARIO
                # Mail::to($user->getEmail())->send($passCifrada);
            }catch (ValidationException $e){
              return redirect()->to('/auth/login');
            }
        }

        $this->guard()->login($user);
       return redirect()->to($this->redirectTo);

    }

}
