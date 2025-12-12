<?php

namespace App\Http\Controllers\Admin\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\Miscellaneous\Helper;
use App\Providers\RouteServiceProvider;
use DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Session;

class AdminloginController extends Controller
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showadminloginform()
    {
        return view('admin.auth.login');
    }

    public function adminlogin(Request $request)
    {
        $credentials = $this->validate($request, [
            'username' => 'required',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt(array_merge($credentials, ['is_accountactive' => 1, 'active' => 1]), $request->get('remember'))) {

            DB::beginTransaction();
            $user = auth()->user();
            $request->session()->regenerate();
            $sessionid = (string) Str::uuid();
            $request->session()->put('sessionid', $sessionid);
            Helper::trackmessage($user, $user, 'admin_web_postadminlogin', session()->getId(), 'WEB', 'Admin Login');
            Helper::deviceInfo($user, session()->getId(), 'WEB');
            DB::commit();
            toast('Hi ' . $user->name . ', You Have Logged In Successfully!', 'success');

            return redirect()->route('admindashboard');
        }

        toast('Invalid Credentials, Please Try Again', 'error', 'top-right');
        return back()->withInput($request->only('username', 'remember'));
    }

    public function logout(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $user = auth()->user();
            Log::info("User : " . $user->name . " Session ID :" . $request->session()->get('sessionid'));
            Helper::trackmessage($user, $user, 'admin_web_adminlogout', session()->getId(), 'WEB', 'Admin Logout');
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            Session::flush();
            return redirect('/');
        } else {
            toast('Please login again !', 'warning');
            return redirect('/');
        }
    }
}
