<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DetailController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SponsorshipController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
// $user_id = Auth::id();
// $user = DB::table('users')->where('id', $user_id)->get();
// $slug = $user[0]->name . '-' . $user[0]->surname;


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function(){
    //dashboard route
    Route::get('/', [DashboardController::class, 'home'])->name('dashboard');
    //details route
    Route::resource('details', DetailController::class)->parameters(['details'=>'detail:slug']);
    //sponsorships route
    Route::resource('sponsorships', SponsorshipController::class)->parameters(['sponsorships'=>'sponsorship:slug']);
    //checkout route
    Route::get('/braintree/token', [SponsorshipController::class, 'getClientToken']);
    //messages route
    Route::resource('messages', MessageController::class)->parameters(['messages'=>'message:subject']);
    //reviews route
    Route::resource('reviews', ReviewController::class)->parameters(['reviews'=>'review:id']);
    //votes route
    Route::resource('votes', VoteController::class);

});

require __DIR__.'/auth.php';
