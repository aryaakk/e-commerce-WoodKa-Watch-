<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\products\CategoryController;
use App\Http\Controllers\products\ProductController;
use App\Http\Controllers\products\ProductImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController as ControllersRedirectController;
use App\Http\Controllers\user\CartController;
use App\Http\Controllers\user\OrderController;
use App\Http\Controllers\user\ProductController as UserProductController;
use App\Http\Controllers\UsersController;
use App\Models\ProductImage;
use Illuminate\Routing\RedirectController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
//verifikasi email user
// Auth::routes(['verify' => true]);


Route::get('/csrf', function () {
    return response()->json([
        'token' => csrf_token()
    ]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('user/account/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('user/account/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('user/account/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('user/account/address', [UsersController::class, 'addres'])->name('user.address');
    Route::patch('user/account/address', [UsersController::class, 'updateAddress'])->name('user.address');
    Route::get('user/purchase', [UsersController::class, 'order'])->name('user.purchase');
});

Route::group(['middleware' => ['auth', 'checkrole:admin']], function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.index');
    Route::resource('admin/category', CategoryController::class);
    Route::resource('admin/product', ProductController::class);
    Route::resource('admin/image', ProductImageController::class);
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

Route::group(['middleware' => ['auth', 'checkrole:user']], function () {
    Route::get('/WoodKa-Watch/home', [UsersController::class, 'index'])->name('user.index');
    Route::get('/collections/timepiece', [UserProductController::class, 'timepiece'])->name('timepiece');
    Route::get('/collections/straps', [UserProductController::class, 'straps'])->name('straps');
    Route::get('/timepiece/product/{productname}/{product}', [UserProductController::class, 'show'])->name('timepiece.detail');
    Route::post('/cart/checkout/detail', [CartController::class, 'showCheckoutDetail'])->name('checkout.detail');
    Route::resource('cart', CartController::class);
    Route::resource('order', OrderController::class);
});

Route::post('payment', [OrderController::class, 'payment'])->name('order.payment');

// untuk page guest
Route::get('/WoodKa-Watch', [GuestController::class, 'index'])->name('guest.index');
Route::get('/collections/timepiece', [UserProductController::class, 'timepiece'])->name('timepiece');
Route::get('/collections/straps', [UserProductController::class, 'straps'])->name('straps');
Route::get('/timepiece/product/{productname}/{product}', [UserProductController::class, 'show'])->name('timepiece.detail');
Route::post('/explore/product', [UserProductController::class, 'index'])->name('product.index');
Route::get('/explore/product', [UserProductController::class, 'index'])->name('product.index');



// Untuk redirect ke Google
Route::get('login/{providers}/redirect', [SocialiteController::class, 'redirect'])
    ->middleware(['guest'])
    ->name('redirect');

// Untuk callback dari Google
Route::get('login/{providers}/callback', [SocialiteController::class, 'callback'])
    ->middleware(['guest'])
    ->name('callback-google');

require __DIR__ . '/auth.php';
