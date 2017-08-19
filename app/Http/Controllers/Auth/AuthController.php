<?php

namespace App\Http\Controllers\Auth;
/*Se añadio */
use App\SocialProvider;
use DB;
use Auth;
use Socialite;
/*Por Defecto*/
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
/*Se añadio */
use Illuminate\Support\Facades\Redirect;
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:user_h10omr',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Se añadio
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /** Se añadio
    * Obtain the user information from GitHub.
    *
    * @return Response
    */
    public function handleProviderCallback($provider)
    {
        try
        {
            //El controlador que obtiene la informacion de google u otra red social
            $socialUser = Socialite::driver($provider)->user();
            /*var_dump($socialUser); //Imprimimos para saber que devuelve el array de google*/
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
        //Verificamos si el id del provedor existe en la tabla del modelo socialprovider
        $socialProvider = SocialProvider::where('provider_id', $socialUser->id)->first();
        /*var_dump($socialProvider); //Este es para saber que devuelve nuestro array*/

        if (!$socialProvider) { //Si no existe en la tabla del modelo socialprovider realizara lo siguiente.

          //echo $socialUser->email;
          //Realizamos consulta con eloquent para saber si existe el correo en la tabla del modelo user de nuestra bd
          $authUser = User::where('email', $socialUser->email)->first();

          if (!$authUser) { //Si me devuelve null mando el siguiente mensaje
            //No existe en el sistema entonces lo añadimos
            //create a new user and provider
            $user = User::firstOrCreate(
                ['name' => $socialUser->name,
                 'email' => $socialUser->email
               ]
            );

            $user->socialProviders()->create(
                ['user_id' => $user->id,
                 'provider_id' => $socialUser->id,
                 'provider' => $provider,
                 'avatarurl' => $socialUser->avatar]
            );
            return redirect('/');
          }
          else { //Si algo distinto a null le mando el siguiente mensaje
            //Es decir existe en la tabla de usuarios pero no en la de provedores hay que añadirlo como una red social nueva

            //Creo el metodo para guardarlo en la tabla social_providers
            $user2=SocialProvider::create(
                ['user_id' => $authUser->id,
                 'provider_id' => $socialUser->id,
                 'provider' => $provider,
                 'avatarurl' => $socialUser->avatar]
            );
            //Creo una consulta para saber si añadio correctamente
            $socialProvider2 = SocialProvider::where('provider_id', $socialUser->id)->first();
            $user3 = $socialProvider2->user;
            auth()->login($user3);
            //notificationMsg('bienvenido', 'Gracias por Iniciar sesión.!!');
            return redirect('/');
          }


        }
        else {
          //Si ya esta registrado en la tabla del modelo social providers lo dejo pasar
          $user = $socialProvider->user;
          auth()->login($user);
          return redirect('/');
        }

    }
}
