<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Supplier;
use Carbon\Carbon;

class AuthController extends Controller
{
    // shows login form

    public function showLogin()
    {
        return view('login');
    }

    // login
  
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {

        $request->session()->regenerate();

        $user = Auth::user();

        // 🔥 ROLE CHECK
        if ($user->role === 'admin') {
            return redirect()->route('statistics');
        } else {
            return redirect()->route('user.dashboard');
        }
    }

    return back()->withErrors([
        'email' => 'Invalid credentials',
    ]);
}
    // shows register form

    public function showRegister()
    {
        return view('register');
    }

    // register
   public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed'
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'user'
    ]);

    Auth::login($user);

    return redirect()->route('user.dashboard');
}

    // dashboard

   public function showDashboard()
{
   if (Auth::user()->role !== 'admin') {
    return redirect()->route('user.dashboard');
}

    $users = User::all();
    return view('admin.dashboard', compact('users'));
}

   
    // edit users
public function updateUser(Request $request, $id)
{
    $user = User::findOrFail($id);

    $user->name = $request->name;
    $user->role = $request->role;

    $user->save();

return redirect()->back()->with('success', 'User updated successfully!');
}



    //  add user

public function addUser(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required',
        'role' => 'required'
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role
    ]);

    return redirect()->back()->with('success', 'User created successfully!');
}

    // delete user

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully!');
    }

    // logout

   public function destroy(Request $request)
{
    Auth::guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login'); // 👈 THIS sends user to login page
}

public function index()
{
    $suppliers = Supplier::all(); // make sure model exists
    return view('admin.suppliers', compact('suppliers'));
}


// statistical dashboard for admin
public function statistics()
{
    $suppliers = Supplier::all();

    $totalUsers = User::where('role','user')->count();

    $totalSuppliers = $suppliers->count();

    $activeSuppliers =
    $suppliers->where('status','active')->count();

    $inactiveSuppliers =
    $suppliers->where('status','inactive')->count();

    $averageRating =
    $suppliers->avg('rating');

    $expiringContracts =
    Supplier::whereBetween(
        'contract_end',
        [
            Carbon::today(),
            Carbon::today()->addDays(30)
        ]
    )->get();

    return view(
        'admin.statistical-dashboard',
        compact(
            'suppliers',
            'totalUsers',
            'totalSuppliers',
            'activeSuppliers',
            'inactiveSuppliers',
            'averageRating',
            'expiringContracts'
        )
    );
}

// PROFILE  
public function profile()
{
    return view('user.profile');
}

public function updateProfile(Request $request)
{
    $user = Auth::user();

    $user->name = $request->name;
    $user->email = $request->email;

    if($request->hasFile('profile_picture')){

        $image = $request->file('profile_picture')
        ->store('profiles','public');

        $user->profile_picture = $image;
    }

    $user->save();

    return back()
    ->with(
        'success',
        'Profile updated successfully'
    );
}


}