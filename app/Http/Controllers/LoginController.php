<?php

namespace App\Http\Controllers;
use Session;
use App\Models\Role;
use App\Models\User;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function getLogin()
    {

        return view('authentication.login');
    }

    public function getSignup()
    {
        $roles = Role::all();
        return view('authentication.signup')->with('roles', $roles);
    }

    public function adminSignup()
    {
        $roles = Role::all();
        return view('authentication.admin-signup')->with('roles', $roles);
    }

    public function postLogin(Request $request)
    {
        $this->validate($request,[
            'username'=>'required',
            'password'=>'required'
        ]);
        if ($request['username'] != "" || $request['password'] != "") {
            $user = User::where('email', $request['username'])->where('username',NULL)->first();
            if (isset($user)) {
                $user->username = $request['username'];
                $user->update();
            }
        if(Auth::attempt(['username'=>$request['username'],'password'=>$request['password']])){
            $user = Auth::user();
            if ($user->status == "1") {
                if ($user->company->status == "1" ) {
                    $roles = $user->roles; 
                    if ($roles->count()>0) {
                        
                        Session::flash('success','Welcome to your admin dashboard '.Auth::user()->name ." ". Auth::user()->surname);
                        return redirect(route('dashboard'));
                    }else {
                        Session::flash('error','Failed to login. User Role is not defined');
                        return redirect()->back();
                    }
                }else {
                    Session::flash('error','Failed to Login. Company Account Suspended');
                    return redirect()->back();
                }
           
            }else {
                Session::flash('error','Failed to Login. User Account Suspended');
                return redirect()->back();
            }

           }else{
            Session::flash('error','Failed to Authenticate user');
            return redirect()->back();
           }
        }else {
            Session::flash('error','Failed to Authenticate user. Input Fields Cannot be null');
            return redirect()->back();
        }

    }


  

    private function sendResetEmail($email, $token)
    {
    //Retrieve the user from the database
    $user = DB::table('users')->where('email', $email)->select('name', 'email')->first();
    //Generate, the password reset link. The token generated is embedded in the link
    $link = 'http://fundiso.co.zw/' . $token . '/reset-password';

    $data= array(
        'name'=> $user->name,
        'email'=>$user->email,
        'link'=>$link
    );
    Mail::send('emails.verify',$data, function($message) use($data){
        $message->to($data['email']);
        $message->subject('Reset Password Notification');
        $message->from("no-reply@fundiso.co.zw");
    });
}

    public function postEmail(Request $request){

        $this->validate($request,[
            'email'=>'required|email|exists:users'
        ]);

        $user = User::where('email', $request->email)->first();

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => Str::random(60),
            'created_at' => Carbon::now()
        ]);


        $tokenData = DB::table('password_resets')
        ->where('email', $request->email)->first();

        if ($this->sendResetEmail($request->email, $tokenData->token)) {
            Session::flash('success','A reset link has been sent to your email address.');
            return redirect()->back();
        } else {
            Session::flash('success','A reset link has been sent to your email address.');
            return redirect()->back();
        }

       }

    public function forgotPassword()
    {
        return view('authentication.forgot-password');
    }
    
    public function resetPassword($token, $id)
    {
        $user = User::find($id);
        return view('authentication.reset-password')->with([
                'token' => $token,
                'user' => $user,
            ]);
    }

    public function logout(Request $request){
        Auth::logout();
        Session::flash('success','Logout Successful');
        return redirect('/login');
    }
}
