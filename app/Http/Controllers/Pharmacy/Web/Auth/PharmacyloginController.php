<?php

namespace App\Http\Controllers\Pharmacy\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\Miscellaneous\Helper;
use App\Providers\RouteServiceProvider;
use Auth;
use DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Session;

class PharmacyloginController extends Controller
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
        $this->middleware('guest.pharmacy')->except('logout');
    }

    public function showpharmacyloginform()
    {
        return view('pharmacy.auth.login');
    }

    public function pharmacylogin(Request $request)
    {
        $credentials = $this->validate($request, [
            'username' => 'required',
            'password' => 'required|min:8',
        ]);

        if (Auth::guard('pharmacy')->attempt(array_merge($credentials, ['is_accountactive' => 1, 'active' => 1]), $request->get('remember'))) {

            DB::beginTransaction();
            $user = Auth::guard('pharmacy')->user();
            $request->session()->regenerate();
            $sessionid = (string) Str::uuid();
            $request->session()->put('sessionid', $sessionid);
            Helper::trackmessage($user, $user, 'Pharmacy Login', 'pharmacy_web_postpharmacylogin', session()->getId(), 'WEB');
            Helper::deviceInfo($user, session()->getId(), 'WEB');
            DB::commit();
            toast('Hi ' . $user->name . ', You Have Logged In Successfully!', 'success');
            return redirect()->route('pharmacydashboard');
        }

        toast('Invalid Credentials, Please Try Again', 'error', 'top-right')->persistent("Close");
        return back()->withInput($request->only('username', 'remember'));
    }

    public function logout(Request $request)
    {
        $user = auth()->guard('pharmacy')->user();
        if ($user) {
            Log::info("Pharmacy : " . $user->name . " Session ID :" . $request->session()->get('sessionid'));
            Helper::trackmessage($user, $user, 'Pharmacy Logout', 'pharmacy_web_pharmacylogout', session()->getId(), 'WEB');
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            Session::flush();
            toast('Hi ' . $user->name . ', You Have Logged Out Successfully!', 'success');
            return redirect('/pharmacy/login');
        } else {
            toast('Please login again !', 'warning');
            return redirect('/pharmacy/login');
        }
    }
}
