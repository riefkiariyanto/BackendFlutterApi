<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ListShopController;
use App\Http\Controllers\ListUserController;
use App\Http\Controllers\TransactionClientController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth:admin'])->name('admin.dashboard');

Route::get('/admin/client_management', function () {
    return view('admin.client_management');
})->middleware(['auth:admin'])->name('admin.client_management');


require __DIR__.'/adminauth.php';

// Route::get('/client/dashboard', function () {
//     return view('client.dashboard');
// })->middleware(['auth:client'])->name('client.dashboard');

// Route::get('/client/product', function () {
//     return view('client.product');
// })->middleware(['auth:client'])->name('client.product');

// Route::get('/client/profile', function () {
//     return view('client.profile');
// })->middleware(['auth:client'])->name('client.profile');

Route::get('client/product', [ProductController::class, 'index'])
->middleware(['auth:client'])
->name('client.product');


// Route::get('/client/add-product', function () {
//     return view('client.add-product');
// })->middleware(['auth:client'])->name('client.add-product');

// Route::controller(ProductController::class,)->group(function(){
//     Route::get('client/add-product','create') ->name('client.add-product');
//     Route::post('client/add-product','store') ->name('client.add-product');

//     // Route::get('client.add-product','store') ->name('client.add-product');

// });

Route::get('/client/dashboard', [HomeController::class, 'index'])
    ->middleware(['auth:client'])
    ->name('client.dashboard');

Route::get('client/add-product', [ProductController::class, 'create'])
->middleware(['auth:client'])
->name('client.add-product');

Route::post('client/store-product', [ProductController::class, 'store'])
->middleware(['auth:client'])
->name('client.store-product');

Route::delete('products/{id}', [ProductController::class, 'destroy'])
->middleware(['auth:client'])
->name('product.delete');

Route::put('products/{id}', [ProductController::class, 'update'])
->middleware(['auth:client'])
->name('product.update');

Route::put('products/image/{id}', [ProductController::class, 'image'])
->middleware(['auth:client'])
->name('product.image');

// Route::get('client/service', [ServiceController::class, 'index'])
// ->middleware(['auth:admin'])
// ->name('client.service');

// Route::get('client/add-service', [ServiceController::class, 'create'])
// ->middleware(['auth:admin'])
// ->name('client.add-service');

// Route::post('client/store-service', [ServiceController::class, 'store'])
// ->middleware(['auth:client'])
// ->name('client.store-service');

// Route::delete('service/{id}', [ServiceController::class, 'destroy'])
// ->middleware(['auth:admin'])
// ->name('service.delete');

// Route::put('service/{id}', [ServiceController::class, 'update'])
// ->middleware(['auth:admin'])
// ->name('service.update');

// Route::put('service/image/{id}', [ServiceController::class, 'image'])
// ->middleware(['auth:admin'])
// ->name('service.image');


Route::get('admin/client', [ListShopController::class, 'index'])
->middleware(['auth:admin'])
->name('admin.client');

Route::get('admin/add-client', [ListShopController::class, 'create'])
->middleware(['auth:admin'])
->name('admin.add-client');

Route::post('admin/store-client', [ListShopController::class, 'store'])
->middleware(['auth:admin'])
->name('admin.store-client');

Route::delete('admin/{id}', [ListShopController::class, 'destroy'])
->middleware(['auth:admin'])
->name('client.delete');

Route::put('validateClient/{id}', [ListShopController::class, 'validateClient'])
->middleware(['auth:admin'])
->name('client.validateClient');

Route::put('client/{id}', [ListShopController::class, 'update'])
->middleware(['auth:admin'])
->name('client.update');

Route::delete('/admin/client/{id}', [ListShopController::class, 'destroy'])
->middleware(['auth:admin'])
->name('client.delete');

Route::get('admin/user', [ListUserController::class, 'index'])
->middleware(['auth:admin'])
->name('admin.user');

Route::get('admin/user/update_status/{id}/{status}', [ListUserController::class, 'activeOrDeactiveUser'])->middleware(['auth:admin']);
Route::get('admin/client/update_status/{id}/{status}', [ListShopController::class, 'activeOrDeactiveClient'])
->middleware(['auth:admin']);

Route::get('admin/add-user', [ListUserController::class, 'create'])
->middleware(['auth:admin'])
->name('admin.add-user');

Route::post('admin/store-user', [ListUserController::class, 'store'])
->middleware(['auth:admin'])
->name('admin.store-user');

Route::delete('client/{id}', [ListUserController::class, 'destroy'])
->middleware(['auth:admin'])
->name('user.delete');

Route::put('client/{id}', [ListUserController::class, 'update'])
->middleware(['auth:admin'])
->name('user.update');

Route::get('client/transaction', [TransactionClientController::class, 'index'])
->middleware(['auth:admin'])
->name('client.transaction');

Route::get('client/add-transaction', [TransactionClientController::class, 'create'])
->middleware(['auth:client'])
->name('client.add-transaction');

Route::post('client/store-transaction', [TransactionClientController::class, 'store'])
->middleware(['auth:client'])
->name('client.store-transaction');

Route::delete('transaction/{id}', [TransactionClientController::class, 'destroy'])
->middleware(['auth:client'])
->name('transaction.delete');

Route::put('transaction/{id}', [TransactionClientController::class, 'update'])
->middleware(['auth:client'])
->name('transaction.update');

Route::put('transaction/{id}', [TransactionClientController::class, 'done'])
->middleware(['auth:client'])
->name('transaction.done');

Route::get('client/profile', [ProfileController::class, 'index'])
->middleware(['auth:client'])
->name('client.profile');

Route::get('client/edit-profile', [ProfileController::class, 'edit'])
->middleware(['auth:client'])
->name('client.edit-profile');

Route::get('client/new-profile', [ProfileController::class, 'create'])
->middleware(['auth:client'])
->name('client.new-profile');

Route::post('client/store-profile', [ProfileController::class, 'store'])
->middleware(['auth:client'])
->name('client.store-profile');

Route::post('client/update-profile', [ProfileController::class, 'updateNew'])
->middleware(['auth:client'])
->name('client.update-profile');

// Route::post('api/list-user', [ListUserController::class, 'listUser']);

require __DIR__.'/clientauth.php';


