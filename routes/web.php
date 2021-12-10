<?php

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

// ============================================================================
// =============================== P U B L I C ================================
// ============================================================================

Route::get('/', 'PageController@welcome')->name('welcome');
Route::get('/katalog', 'PageController@katalog')->name('katalog');
Route::get('/detail-produk/{id_product}', 'PageController@detailProduk')->name('detailProduk');


// ============================================================================
// ================================ L O G I N =================================
// ============================================================================

Auth::routes();

Route::middleware('auth')->group(function () {

    // Admin Home
    Route::get('/home', 'HomeController@index')->name('home');


    Route::prefix('admin')->middleware('admin')->group(function () {

        // ===========================================================
        // ========================= DEFAULT =========================
        // ===========================================================

        // Store
        Route::prefix('profile')->name('profile')->group(function () {
            Route::get('/', 'ProfileController@index')->name('');
            Route::put('/', 'ProfileController@update')->name('.update');
        });

        // ===========================================================
        // ======================= MANAGEMENT ========================
        // ===========================================================

        // Users
        Route::prefix('user')->name('user')->group(function () {
            Route::get('/', 'UsersController@index')->name('');
            Route::get('/create', 'UsersController@create_view')->name('.create');
            Route::post('/create', 'UsersController@create_process')->name('.create.process');
            Route::get('/update/{id}', 'UsersController@update_view')->name('.update');
            Route::post('/update/{id}', 'UsersController@update_process')->name('.update.process');
            Route::post('/update-password/{id}', 'UsersController@change_password')->name('.update.password.process');
            Route::get('/delete/{id}', 'UsersController@delete')->name('.delete');
        });

        // Categories
        Route::prefix('category')->name('category')->group(function () {
            Route::get('/', 'CategoryController@index')->name('');
            Route::get('/create', 'CategoryController@create_view')->name('.create');
            Route::post('/create', 'CategoryController@create_process')->name('.create.process');
            Route::get('/update/{id}', 'CategoryController@update_view')->name('.update');
            Route::post('/update/{id}', 'CategoryController@update_process')->name('.update.process');
            Route::get('/delete/{id}', 'CategoryController@delete')->name('.delete');
        });

        // Product
        Route::prefix('product')->name('product')->group(function () {
            Route::get('/', 'ProductsController@index')->name('');
            Route::get('/create', 'ProductsController@create_view')->name('.create');
            Route::post('/create', 'ProductsController@create_process')->name('.create.process');
            Route::get('/update/{id}', 'ProductsController@update_view')->name('.update');
            Route::post('/update/{id}', 'ProductsController@update_process')->name('.update.process');
            Route::get('/delete/{id}', 'ProductsController@delete')->name('.delete');
        });

        // Materials
        Route::prefix('material')->name('material')->group(function () {
            Route::get('/{id_product}', 'MaterialController@index')->name('');
            Route::get('/{id_product}/create', 'MaterialController@create_view')->name('.create');
            Route::post('/{id_product}/create', 'MaterialController@create_process')->name('.create.process');
            Route::get('/{id_product}/update/{id}', 'MaterialController@update_view')->name('.update');
            Route::post('/{id_product}/update/{id}', 'MaterialController@update_process')->name('.update.process');
            Route::get('/{id_product}/delete/{id}', 'MaterialController@delete')->name('.delete');
        });

        // Cart
        Route::prefix('cart')->name('cart')->group(function () {
            Route::get('/', 'CartController@index')->name('');
            Route::get('/create', 'CartController@create_view')->name('.create');
            Route::post('/create', 'CartController@create_process')->name('.create.process');
            Route::get('/delete/{id}', 'CartController@delete')->name('.delete');
        });

        // Checkout
        Route::prefix('checkout')->name('checkout')->group(function () {
            Route::get('/', 'CheckoutController@index')->name('');
            Route::get('/create', 'CheckoutController@create_view')->name('.create');
            Route::post('/create', 'CheckoutController@create_process')->name('.create.process');
            Route::get('/delete/{id}', 'CheckoutController@delete')->name('.delete');
        });

        // Order
        Route::prefix('order')->name('order')->group(function () {
            Route::get('/', 'OrderController@index')->name('');
            Route::get('/create', 'OrderController@create_view')->name('.create');
            Route::post('/create', 'OrderController@create_process')->name('.create.process');
            Route::get('/delete/{id}', 'OrderController@delete')->name('.delete');
        });

        // ===========================================================
        // =========================== END ===========================
        // ===========================================================


    });
});
