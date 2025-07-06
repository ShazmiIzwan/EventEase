<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeOrganiserController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\RefundController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Customer;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\LogisticController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Student;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['guest']], function () {
    // Authentication
    Route::get('/', [AuthController::class, 'index'])->name('login');

    //AUTH Customer
    Route::get('register-user', [AuthController::class, 'register']);
    Route::post('register-post', [AuthController::class, 'registerpost'])->name('register-post');
    Route::post('login-user', [AuthController::class, 'login']);

});

// Route::group(['middleware' => ['guest']], function () {
//     // Show Login Form
//     Route::get('login-user', [AuthController::class, 'index'])->name('login');

//     // Process Login
//     Route::post('login-user', [AuthController::class, 'login']);

//     // Registration
//     Route::get('register-user', [AuthController::class, 'register']);
//     Route::post('register-post', [AuthController::class, 'registerpost'])->name('register-post');
// });


Route::group(['middleware' => ['auth']], function () {


Route::get('signout-user', [AuthController::class, 'signout']);

Route::middleware([Student::class])->group(function () {
    //Customer
    Route::get('student-home', [HomeController::class, 'index']);
});

Route::get('viewEvent/{id}', [EventController::class, 'viewEvent']);
Route::post('checkout', [EventController::class, 'checkout']);
Route::post('confirmregister', [EventController::class, 'confirmregister']);
Route::get('myreg', [EventController::class, 'myreg']);
Route::any('events', [EventController::class, 'events']);


// Cancel
Route::post('/cancelRegistration/{id}', [EventController::class, 'cancel'])
    ->name('registrations.cancel');

// Print Certificate
Route::get('/printCertificate/{id}', [EventController::class, 'printCertificate'])
    ->name('registrations.certificate');


//Support
Route::get('mysupport', [SupportController::class, 'index']);
Route::post('sendReply/{id}', [SupportController::class, 'reply']);
Route::post('startChat', [SupportController::class, 'startChat']);


Route::middleware([admin::class])->group(function () {
    Route::get('home-admin', [AdminController::class, 'index']);

    Route::get('/users',            [UserController::class, 'index']);
    Route::post('/postUser',        [UserController::class, 'postUser']);
    Route::get('/fetchUser',        [UserController::class, 'fetchUser']);
    Route::get('/removeUser/{id}',  [UserController::class, 'removeUser']);
});

//Event Management
Route::get('eventsmanagement', [HomeOrganiserController::class, 'eventsmanagement']);
Route::POST('postEvent', [EventController::class, 'store']);
Route::get('fetchEvent', [EventController::class, 'fetchEvent']);
Route::any('removeEvent/{id}', [EventController::class, 'removeEvent']);

Route::any('generateCert/{id}', [EventController::class, 'generateCert']);


//Testing
Route::get('testing', [EventController::class, 'testing']);


//order management
Route::get('regmanagement', [HomeOrganiserController::class, 'regmanagement']);
Route::get('fetchReg', [HomeOrganiserController::class, 'fetchReg']);
Route::get('mysupportadmin', [SupportController::class, 'mysupportadmin']);
Route::post('sendReplyAdmin/{id}', [SupportController::class, 'replyAdmin']);




Route::get('/logistics',            [LogisticController::class, 'index'])->name('logistics.index');
Route::post('/postLogistic',        [LogisticController::class, 'postLogistic'])->name('logistics.post');
Route::get('/fetchLogistic',        [LogisticController::class, 'fetchLogistic'])->name('logistics.fetch');
Route::get('/removeLogistic/{id}',  [LogisticController::class, 'removeLogistic'])->name('logistics.remove');
});
