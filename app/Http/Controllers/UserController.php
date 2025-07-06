<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

//User management functionality

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at','desc')->get();
        return view('users.index', compact('users'));
    }

    public function postUser(Request $request)
    {
        $type = $request->input('type'); 
    
        $emailRules = ['required', 'email'];
        if ($type === 'C') {
            $emailRules[] = 'unique:users,email';
        } else {
            $emailRules[] = Rule::unique('users','email')->ignore($request->input('id'));
        }
    
        $request->validate([
            'email' => $emailRules
        ]);
    
        if ($type === 'C') {
            $user = new User;
            $user->email     = $request->input('email');
            $user->name      = $request->input('name');
            $user->phone     = $request->input('phone');
            $user->role      = $request->input('role');
            $user->status    = $request->input('status');
            $user->password  = Hash::make($request->input('password'));
            $user->save();
    
            return redirect()->back()->with('success','User created.');
        }
    
        if ($type === 'E') {
            $user = User::findOrFail($request->input('id'));
            $user->email   = $request->input('email');
            $user->name    = $request->input('name');
            $user->phone   = $request->input('phone');
            $user->role    = $request->input('role');
            $user->status  = $request->input('status');
    
            if ($request->filled('password')) {
                $user->password = Hash::make($request->input('password'));
            }
    
            $user->save();
    
            return redirect()->back()->with('success','User updated.');
        }
    
        return redirect()->back()->with('error','Invalid operation.');
    }

    public function fetchUser(Request $request)
    {
        $user = User::findOrFail($request->id);
        return response()->json($user);
    }

    public function removeUser($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back()->with('success','User removed.');
    }
}
