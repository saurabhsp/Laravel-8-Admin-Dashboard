<?php

use App\Http\Controllers\AdminController;
use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\ResetPassword;
use App\Http\Livewire\Billing;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\ExampleLaravel\UserManagement;
use App\Http\Livewire\ExampleLaravel\UserProfile;
use App\Http\Livewire\Notifications;
use App\Http\Livewire\Profile;
use App\Http\Livewire\RTL;
use App\Http\Livewire\StaticSignIn;
use App\Http\Livewire\StaticSignUp;
use App\Http\Livewire\Tables;
use App\Http\Livewire\VirtualReality;
use GuzzleHttp\Middleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return redirect('login');
});

Route::get('forgot-password', ForgotPassword::class)->name('password.forgot');
Route::get('reset-password/{id}', ResetPassword::class)->middleware('signed')->name('reset-password');




Route::get('signup', Register::class)->name('register');
Route::get('login', Login::class)->name('login');

Route::get('user-profile', UserProfile::class)->name('user-profile');
Route::get('user-management', UserManagement::class)->name('user-management');

Route::get('dashboard', Dashboard::class)->name('dashboard');
Route::get('billing', Billing::class)->name('billing');
Route::get('profile', Profile::class)->name('profile');
Route::get('tables', Tables::class)->name('tables');
Route::get('notifications', Notifications::class)->name("notifications");
Route::get('virtual-reality', VirtualReality::class)->name('virtual-reality');
Route::get('static-sign-in', StaticSignIn::class)->name('static-sign-in');
Route::get('static-sign-up', StaticSignUp::class)->name('static-sign-up');
Route::get('rtl', RTL::class)->name('rtl');

Route::group(['middleware' => 'auth'], function () {
});


Route::get('admin/signup', [AdminController::class, 'showSignupForm'])->name('admin.signup');
Route::post('admin/signup', [AdminController::class, 'adminSignup']);
Route::get('admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'adminLogin'])->name('admin.login.submit');
Route::get('admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');

Route::middleware(['admin'])->group(function () {
    Route::get('admin/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('admin/users', UserManagement::class)->name('user-manage');
    Route::get('admin/users/{id}/toggle-status', [UserManagement::class, 'toggleStatus'])->name('admin.users.toggle-status');
    Route::get('admin/users/create', [UserManagement::class, 'create'])->name('admin.users.create');
    Route::post('admin/users/store', [UserManagement::class, 'store'])->name('admin.users.store');
    Route::get('admin/users/{id}/edit', [UserManagement::class, 'edit'])->name('admin.users.edit');
    Route::put('admin/users/{id}/update', [UserManagement::class, 'update'])->name('admin.users.update');
    Route::get('admin/users/{id}/delete', [UserManagement::class, 'destroy'])->name('admin.users.delete');
      
});