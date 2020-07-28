<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Level;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

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

    public function login(Request $request)

    {   
        // return $request;
        $input = $request->all();

  

        $this->validate($request, [

            'username' => 'required',

            'password' => 'required',

        ]);
        
        $valided = array(
            'username'=>$input['username'], 
            'password' => $input['password'],
            'row_status' =>'1'
        );

        // $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        // dd(Auth::attempt($valided));
// return $input;
        if(auth()->attempt($valided))
        {
        //     $user = User::get()->where('username',$input['username'])->where('row_status','1');
        //     foreach($user as $u){
        //     $level = Level::get()->where('id',$u->level_id);
        //     foreach ($level as $l) {
        //         $nameParts = explode(' ', $u->username);//REMEMBER TO EDIT
	    //         $firstName = $nameParts[0];
        //         $data = [
        //             'username' => $firstName,
        //             'level' => $l->level,
        //             'id_level' =>$u->level_id
        //         ];
        //     }
        // }
        // return $user;
        // $request->session()->put('data',$data);
                // dd(session()->get('data'));
                Alert::success('Login Berhasil!',"Selamat ".$input['username']." telah berhasil login.")->persistent('Close');
             return redirect()->route('home');
        }else{
            Alert::error('Login Failed!',"Username and Password as Wrong.")->persistent('Close');
            return redirect()->route('login');
        }
    }
    
}
