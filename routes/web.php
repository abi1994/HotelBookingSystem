<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BotManController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewPasswordController;
use App\Http\Controllers\PasswordResetLinkController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomtypeController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\InventoryItemController;
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

// Admin Login
Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'checkLogin']);

// Forgot Password
Route::get('/forgot-password/request', [PasswordResetLinkController::class, 'create']);
Route::post('/forgot-password/email', [PasswordResetLinkController::class, 'store']);

//Reset Password
Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store']);

//login customer
Route::get('login', [CustomerController::class, 'login'])->name('login');
Route::post('customer/login', [CustomerController::class, 'customerLogin']);
Route::get('register', [CustomerController::class, 'register']);
Route::resource('admin/customer', CustomerController::class);

Route::get('admin/logout', [AdminController::class, 'logout']);
Route::get('logout', [CustomerController::class, 'logout']);

//Home
Route::get('/', [HomeController::class, 'home']);
Route::get('/service/{id}', [HomeController::class, 'serviceDetail']);
Route::get('/imaginable', [HomeController::class, 'imaginable']);
// Admin Dashboard
Route::get('admin', [AdminController::class, 'dashboard']);

// Banner Routes
Route::get('admin/banner/{id}/delete', [BannerController::class, 'destroy']);
Route::resource('admin/banner', BannerController::class);

// RoomType Routes
Route::get('admin/roomtype/{id}/delete', [RoomtypeController::class, 'destroy']);
Route::resource('admin/roomtype', RoomtypeController::class);

// Room
Route::get('admin/rooms/{id}/delete', [RoomController::class, 'destroy']);
Route::resource('admin/rooms', RoomController::class);
Route::get('/rooms/search', [RoomController::class, 'search']);


// Customer
Route::get('admin/customer/{id}/delete', [CustomerController::class, 'destroy']);

// Delete Image
Route::get('admin/roomtypeimage/delete/{id}', [RoomtypeController::class, 'destroyImage']);

// Booking
Route::get('admin/booking/{id}/delete', [BookingController::class, 'destroy']);
Route::get('admin/booking/available-rooms/{checkin_date}', [BookingController::class, 'availableRooms']);
Route::resource('admin/booking', BookingController::class);

Route::get('booking', [BookingController::class, 'frontBooking']);
Route::get('booking/success', [BookingController::class, 'bookingPaymentSuccess']);
Route::get('booking/fail', [BookingController::class, 'bookingPaymentFail']);

// Service CRUD
Route::get('admin/service/{id}/delete', [ServiceController::class, 'destroy']);
Route::resource('admin/service', ServiceController::class);

//gallery
Route::get( 'imageable', [\App\Http\Controllers\GalleryController::class, 'store']);

//Profile
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->middleware('auth');
Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->middleware('auth');


//Contact-us
Route::get('/contact-us', [ContactController::class, 'index']);
Route::post('/contact-us', [ContactController::class, 'store']);
Route::post('/respond-contact/{id}', [ContactController::class, 'respond']);
Route::post('/close-contact/{id}', [ContactController::class, 'close']);

//inventory
Route::get('admin/inventory-items', [InventoryItemController::class, 'index']); // For fetching the list
Route::post('admin/inventory-items/store', [InventoryItemController::class, 'store']);
Route::get('admin/inventory/{id}/delete', [InventoryItemController::class, 'destroy']); // For deleting an item
Route::get('admin/inventory-items/edit/{id}', [InventoryItemController::class, 'edit']);
Route::put('admin/inventory-items/update/{id}', [InventoryItemController::class, 'update']);
Route::get('admin/inventory-items/create', [InventoryItemController::class, 'create']);

// BotMan
Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);
