<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class CustomAuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function register(Request $request)
    {

        $user = new User();
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

    public function loginUser(Request $request)
    {
        /* $validator = Validator::make($request->all(), [
             'email' => 'required|email',
             'password' => 'required|min:8',
         ]);

         if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput();
         }*/

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')->with('success', 'Login successful.');
        }

        return redirect()->back()->withErrors(['email' => 'These credentials do not match our records.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', "You have been logged out.");
    }

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'mobile' => 'required|digits:10',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}


