<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Auth.login');
    }

    public function register()
    {
        return view('Auth.register');
    }

    public function index_admin()
    {
        return view('Auth.login-admin');
    }

    public function register_admin()
    {
        return view('Auth.register-admin');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login(Request $request)
    {
        $user = User::where('email',$request->input('email'))->first();

        if($user != ''){

            if(Hash::check($request->input('password'), $user->password)){
                auth()->login($user);

                if(auth()->user()->role == 'Student'){

                return redirect()->to('/student-home');
                }
                else if(auth()->user()->role == 'Committee'){
                    return redirect()->to('/eventsmanagement');
                }
                else if(auth()->user()->role == 'Lecturer'){
                    return redirect()->to('/eventsmanagement');
                }
                else if(auth()->user()->role == 'Admin'){
                    return redirect()->to('/home-admin');
                }
            }
            else{
                return redirect()->back()->with('error', 'The Email or Password is incorrect, Please try again');
            }
        }
        else{
            return redirect()->back()->with('error', 'The Email or Password is incorrect, Please try again');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function registerpost(Request $request)
    {
       
        $rules = [
            'name' => [
                'required',
                'string',
                'min:0',
                'max:100',            
            ],
            'email' =>  [
                'required',
                'string',
                'email',
                'min:0',
                'max:255',
                'unique:users,email', 
            ],
            'phone' =>  [
                'required',
                'string',
                'min:9',
                'max:20'           
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:32',            
                'regex:/[a-z]/',     
                'regex:/[A-Z]/',     
                'regex:/[0-9]/',     
                'regex:/[@$!%*#?&]/', 
            ],
           

          
        ];

        $messages = array(
           
        );
        
        $this->validate($request, $rules,$messages);

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $phone = $request->input('phone');
        $role = 'Student';
        

        $user = User::create(request(['name', 'email', 'phone', 'role', 'status', 'email_verified_at', 'password']));
		$user->password = Hash::make($password);
		$user->email = $email;
        $user->phone = $phone;
        $user->name = $name;
        $user->role = $role;
        $user->save();
        auth()->login($user);

        if($role == 'Student'){
        return redirect()->to('/student-home');
        }
        else if($role == 'Committee'){
        return redirect()->to('/home-Committee');
        }
        else if($role == 'Lecturer'){
        return redirect()->to('/home-Lecturer');
        }
        else{
        return redirect()->to('/home-admin');
        }
    }




   
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function signout(Request $request)
    {
        auth()->logout();
        return redirect('/');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
