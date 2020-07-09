<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest')->except('validateUser');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {   
        if(blank(User::where('identification',$data['identification'])->first())){
            return Validator::make($data, [
                'email' => ['unique:users'],
            ]);
        }

        return Validator::make($data, [
            'email' => ['required'],
        ]);
        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {   if(blank(User::where('identification',$data['identification'])->first())){
            return User::create([
                'name' => $data['name'],
                'identification'=>$data['identification'],
                'age'=>$data['age'],
                'phone'=>$data['phone'],
                'ocupation'=>$data['ocupation'],
                'email' => $data['email'],
                'creation'=>true,
                'image'=>'generic.png',
                'password' => Hash::make($data['password']),
            ]);
        }

           return User::where('identification',$data['identification'])->update([
                'name' => $data['name'],
                'identification'=>$data['identification'],
                'age'=>$data['age'],
                'phone'=>$data['phone'],
                'ocupation'=>$data['ocupation'],
                'email' => $data['email'],
                'creation'=>true,
                'image'=>'generic.png',
                'password' => Hash::make($data['password']),
            ]);
        
    }
    
    public function validateUser($id){
        try {
            return User::where('identification', $id)->first();
        } catch (Exception $e) {
            return'Excepción capturada:'.$e->getMessage();
        }
    }

}
