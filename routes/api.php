<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ListShopController;
use App\Http\Controllers\ListUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TransactionClientController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/test', function () {
    return response([
        'message' => 'Api is working'
    ], 200);    
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'Login']);

Route::get('get-user/{id}', [ListUserController::class, 'getUserById']);
Route::get('list-user', [ListUserController::class, 'listUser']);
Route::post('add-user', [ListUserController::class, 'postUser']);
Route::put('edit-user/{id}', [ListUserController::class, 'editUser']);
Route::delete('delete-user/{id}', [ListUserController::class, 'deleteUser']);

Route::get('get-client/{id}', [ListShopController::class, 'getClientById']);
Route::get('list-client', [ListShopController::class, 'listClient']);
Route::post('add-client', [ListShopController::class, 'postClient']);
Route::put('edit-client/{id}', [ListShopController::class, 'editClient']);
Route::delete('delete-client/{id}', [ListShopController::class, 'deleteClient']);

Route::get('get-biodata-client/{id}', [ListShopController::class, 'getBiodataClientById']);
Route::get('get-biodata-client', [ListShopController::class, 'getBiodataClient']);
Route::post('add-biodata-client', [ListShopController::class, 'postBiodataClient']);
Route::put('edit-biodata-client/{id}', [ListShopController::class, 'editBiodataClient']);
Route::delete('delete-biodata-client/{id}', [ListShopController::class, 'deleteBiodataClient']);

Route::get('get-product/{id}', [ProductController::class, 'getProductById']);
Route::get('get-store-prodcut', [ProductController::class, 'showBiodataShop']);
Route::get('list-product/shop', [ProductController::class, 'listProductShop']);

Route::get('list-product', [ProductController::class, 'listProduct']);
Route::post('add-product', [ProductController::class, 'postProduct']);
Route::put('edit-product/{id}', [ProductController::class, 'editProduct']);
Route::delete('delete-product/{id}', [ProductController::class, 'deleteProduct']);

Route::get('get-service/{id}', [ServiceController::class, 'getServiceById']);
Route::get('list-service', [ServiceController::class, 'listService']);
Route::post('add-service', [ServiceController::class, 'postService']);
Route::put('edit-service/{id}', [ServiceController::class, 'editService']);
Route::delete('delete-service/{id}', [ServiceController::class, 'deleteService']);

Route::get('list-cart', [TransactionClientController::class, 'listCart']);
Route::get('cart/id-product-user', [TransactionClientController::class, 'getIdProductAndIdUser']);
Route::post('add-cart', [TransactionClientController::class, 'postCart']);
Route::post('add-cart-id', [TransactionClientController::class, 'postCartID']);
Route::put('edit-cart/{id}', [TransactionClientController::class, 'editCart']);
Route::put('update-cart-quantity/{cartId}', [TransactionClientController::class, 'updateCartQuantity']);

Route::delete('delete-cart/{id}', [TransactionClientController::class, 'deleteByIdCart']);

Route::get('get-transaction/{id}', [TransactionClientController::class, 'getTransactionById']);
Route::get('list-transaction', [TransactionClientController::class, 'listTransaction']);
Route::post('add-transaction', [TransactionClientController::class, 'postTransaction']);
Route::put('edit-transaction/{id}', [TransactionClientController::class, 'editTransaction']);
Route::delete('delete-transaction/{id}', [TransactionClientController::class, 'deleteTransaction']);

// Route::get('all-shops-and-products', [ListShopController::class, 'getAllShopsAndProducts']);
Route::get('all-shops-and-products', [ListShopController::class, 'getAllShopsAndProducts']);




