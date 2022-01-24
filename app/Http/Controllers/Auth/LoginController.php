<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Socialite;


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


    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleProviderCallback(Request $request, $provider)
    {
        if($provider == 'twitter') {
            // なにもしない
        } else {
            // statelessメソッドはセッション状態の確認を無効にするために使用します。
            // これはAPIへソーシャル認証を追加する場合に便利です。
            $user = Socialite::driver('github')->user();
            $loginUser = User::gitFindOrCreate($user);
            Auth::loginUsingId($loginUser->id, $remember = true);
            return redirect()->to('/index');
        }
    }
}
