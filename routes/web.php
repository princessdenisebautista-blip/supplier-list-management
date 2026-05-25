<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupplierController;
use App\Models\Supplier;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => redirect()->route('login'));

Route::get('/login', [AuthController::class,'showLogin'])->name('login');
Route::post('/login', [AuthController::class,'login']);

Route::get('/register', [AuthController::class,'showRegister'])->name('register');
Route::post('/register', [AuthController::class,'register'])->name('register.post');

/*
|--------------------------------------------------------------------------
| Protected
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // ADMIN DASHBOARD
    Route::get('/dashboard',
        [AuthController::class,'showDashboard']
    )->name('dashboard');

    // USER DASHBOARD
  Route::get('/user-dashboard', function () {
    $suppliers = Supplier::all();
    return view('user.index', compact('suppliers'));
})->name('user.dashboard');

    // USERS CRUD
Route::get('/users', function () {
    $users = User::all();
    return view('admin.dashboard', compact('users'));
})->name('users.index');

    Route::post('/user/add',
        [AuthController::class,'addUser']
    )->name('user.add');

    Route::put('/user/{id}',
        [AuthController::class,'updateUser']
    )->name('user.update');

    Route::delete('/user/{id}',
        [AuthController::class,'deleteUser']
    )->name('user.delete');

    // SUPPLIERS
    Route::get('/suppliers',
        [SupplierController::class,'index']
    )->name('suppliers');

    Route::post('/supplier/add',
        [SupplierController::class,'store']
    )->name('supplier.add');

    Route::put('/supplier/{id}',
        [SupplierController::class,'update']
    )->name('supplier.update');

    Route::delete('/supplier/{id}',
        [SupplierController::class,'destroy']
    )->name('supplier.delete');

    // STATISTICS
    Route::get('/statistical-dashboard',
        [AuthController::class,'statistics']
    )->name('statistics');

    // LOGOUT
    Route::get('/logout',
        [AuthController::class,'destroy']
    )->name('logout');
});