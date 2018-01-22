<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\User;

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

    public function doLogin(Request $request){

       if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            
            $header = Auth::basic();      
            $response = array('basic' => $header);
            return response()->json($response);
       }
       else{

           $response = array('success' => false, 'message' => 'Invalid login credentials');

           return response()->json($response, 401);
       }
    }

    public function doLogout(){
        Auth::logout();
    }

    public function createUser(Request $request){
        $user = new User();
        $user->name = $request['name'];
        $user->password = bcrypt($request['password']);
        $user->email = $request['email'];
        $user->save();
        return response()->json($user, 200);

    }
}
