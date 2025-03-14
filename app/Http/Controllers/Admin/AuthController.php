<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function dashboard()
    {
        // Retrieve the count of users
        $userCount = User::count();
        
        // Retrieve the count of products
        $productCount = Product::count();

       // Retrieve the count of news
        $contentCount = Content::count();
    
        // Pass both user count and product count to the dashboard view
        return view('dashboard', ['userCount' => $userCount, 'productCount' => $productCount,'contentCount' => $contentCount ]);
    }
    
    

    public function register()
    {
        return view('auth/register');
    }

    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ])->validate();
    
        $role = (strpos($request->email, 'sakthiganapathi@dbcyelagiri.edu.in') !== false) ? $request->input('role', 'user') : 'user';
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);
    
        return redirect()->route('login');
    }

    public function userregisterSave(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ])->validate();
    
        $role = (strpos($request->email, 'sakthiganapathi@dbcyelagiri.edu.in') !== false) ? $request->input('role', 'user') : 'user';
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);
    
        return redirect()->route('users.index');
    }
    
    

    public function login()
    {
        return view('auth/login');
    }

    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();
    
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }
    
        $request->session()->regenerate();
    
        // Record login activity
        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'login_time' => now(),
        ]);
    
        return redirect()->route('admin.dashboard');
    }
    
    public function logout(Request $request)
    {
        // Record logout activity
        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'logout_time' => now(),
        ]);
    
        Auth::guard('web')->logout();
    
        $request->session()->invalidate();
    
        return redirect('/');
    }
    public function profile()
    {
        return view('profile');
    }

    public function users()
{
    $users = DB::table('users')->select('id', 'name', 'email', 'role' ,'password')->get();

    return view('users.users', compact('users'));
}

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
 
        return view('users.edit', compact('user'));
    }
    
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
 
        $user->update($request->all());
 
        return redirect()->route('users.index', $id)->with('success', 'User updated successfully');
    }
    public function destroy($id)
    {
        $user =  User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'User deleted successfully.');
        }
        return redirect()->route('users.index')->with('error', 'User not found.');
    }

}