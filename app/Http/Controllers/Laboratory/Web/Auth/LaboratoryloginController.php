<?php

namespace App\Http\Controllers\Laboratory\Web\Auth;

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

class LaboratoryloginController extends Controller
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
        $this->middleware('guest.laboratory')->except('logout');
    }

    public function showlaboratoryloginform()
    {
        return view('laboratory.auth.login');
    }

    public function laboratorylogin(Request $request)
    {
        $credentials = $this->validate($request, [
            'username' => 'required',
            'password' => 'required|min:8',
        ]);

        if (Auth::guard('laboratory')->attempt(array_merge($credentials, ['is_accountactive' => 1, 'active' => 1]), $request->get('remember'))) {
            DB::beginTransaction();
            $user = auth()->guard('laboratory')->user();
            $request->session()->regenerate();
            $sessionid = (string) Str::uuid();
            $request->session()->put('sessionid', $sessionid);
            Helper::trackmessage($user, $user, 'Laboratory Login', 'laboratory_web_postlaboratorylogin', session()->getId(), 'WEB');
            Helper::deviceInfo($user, session()->getId(), 'WEB');
            DB::commit();
            toast('Hi ' . $user->name . ', You Have Logged In Successfully!', 'success');
            return redirect()->route('investigationdashboard');
        }
        toast('Invalid Credentials, Please Try Again', 'error', 'top-right')->persistent("Close");
        return back()->withInput($request->only('username', 'remember'));
    }

    public function logout(Request $request)
    {
        $user = auth()->guard('laboratory')->user();
        if ($user) {
            Log::info("Laboratory : " . $user->name . " Session ID :" . $request->session()->get('sessionid'));
            Helper::trackmessage($user, $user, 'Laboratory Logout', 'laboratory_web_laboratorylogout', session()->getId(), 'WEB');
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            Session::flush();
            return redirect('/laboratory/login');
        } else {
            toast('Please login again !', 'warning');
            return redirect('/laboratory/login');
        }
    }
}
