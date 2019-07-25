<?php

namespace App\Http\Controllers\Auth;

// use Auth;
use App\User;
use Socialite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
    protected $redirectTo = '/';

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
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        if (!session()->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
        }
        
        return view('auth.login');    
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        if ($request->wantsJson()) {
            return response()->json([], 204);
        }

        return redirect('/');
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $field = $this->field($request);

        return [
            $field => $request->get($this->username()),
            'password' => $request->get('password'),
        ];
    }

    /**
     * Determine if the request field is email or username.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function field(Request $request)
    {
        $email = $this->username();

        return filter_var($request->get($email), FILTER_VALIDATE_EMAIL) ? $email : 'username';
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $field = $this->field($request);

        $messages = ["{$this->username()}.exists" => 'Такий обліковий запис не зареєстровано або його вимкнено.'];

        $this->validate($request, [
            $this->username() => "required|exists:users,{$field}",
            'password' => 'required',
        ], $messages);
    }

    /**
     * Redirect the user to the given provider authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        if (!session()->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
        }
        
        // return session()->all();
        
        // return $provider;

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from given provider.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {

        $userSocial = Socialite::driver($provider)->user();

        $user = User::where(['email' => $userSocial->getEmail()])->first();
        
        if (!$user) {
            $password = $this->passwordGenerator();
            
            $name = $userSocial->getName();
            
            $username = Str::slug($name);
            
            $user = User::create([
                'name'          => $name,
                'username'      => $username,
                'email'         => $userSocial->getEmail(),
                'password'      => $password,
                'picture'       => $userSocial->getAvatar(),
                'provider_id'   => $userSocial->getId(),
                'provider'      => $provider,
            ]);
        }
        
        auth()->login($user);
        
        $url = session('url.intended') ?? '/';
        
        return redirect($url);
    }
    
    private function passwordGenerator () {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = 12;
        $password = '';
        
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, $length - 1)];
        }
        
        return Hash::make($password);
    }
}
