<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\RoleHasPermissionController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemImageController;
use App\Facades\facadeClass;

// Route::get('/custom-facade', function () {
//      return helper::index();
//  })->name('custom-facade');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/shop/{id}', function ($id) {

    $item = helper::getItemById($id);
    return view('shope', compact('item'));
})->name('shop');


// Middleware to protect dashboard routes for super admins and admins
Route::group(['middleware' => ['role_id:1,2']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
    Route::resource('roles', RoleController::class);

    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('subcategories', SubcategoryController::class);
    Route::resource('items', ItemController::class);
    Route::resource('item_images', ItemImageController::class);

    Route::resource('products', PermissionController::class);
    Route::resource('role_has_permissions', RoleHasPermissionController::class);
    Route::post('/item-images', [ItemImageController::class, 'storeImages'])->name('item-images');

});
// Route::get('users-detail',[DashboardController::class,'users'])->name('users-detail');

// Resource route for users
Route::resource('users', UserController::class);

// Auth routes
Route::get('login', [RegisterController::class, 'showAuthForm'])->name('login');
Route::post('login', [RegisterController::class, 'storelogin'])->name('login');
Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::get('logout', [RegisterController::class, 'logout'])->name('logout');



Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


Route::group(['middleware' => ['auth']], function() {



});
