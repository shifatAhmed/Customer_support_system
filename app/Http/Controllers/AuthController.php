<?php

namespace App\Http\Controllers;
use Illuminate\Validation\ValidationException;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use DB;
use Hash;
use Auth;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function login(Request $request){
        $request->validate([
            'email'=> 'required|email',
            'password' => 'required|min:6'
        ]);
        $user = User::where('email', $request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                Auth::login($user);
                $request->session()->regenerate();
                return redirect()->intended('/dashboard');

            }
            else{
                throw ValidationException::withMessages([
                    'password' => 'incorrect password.',
                ]);
            }
        }
        throw ValidationException::withMessages([
            'email' => 'The provided credentials do not match our records.',
        ]);

    }

    public function register(){
        //dd('dsa');
        return view('auth.register');
    }

    public function registration(Request $request){

        $validator = Validator::make($request->all(),[
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|max:255|unique:users,email',
            'password'   => [
                'required',
                'min:6',
                'confirmed'
            ]

        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction();
        try{
           $user= User::create([
                'name' => $request->first_name.' '.$request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'type' => 2,
           ]);
           
           DB::commit();
           auth()->login($user);
        }
        catch(\Exception $e){
            DB::rollBack();
            return back()->with('error_message', 'Failed to create your account. Please contact system administrator.');
        }

        
    }
}
