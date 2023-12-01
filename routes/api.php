<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('/v1')->group(function () {
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::middleware(['checkAdmin'])->group(function () {
            Route::post('/products', [\App\Http\Controllers\Api\ProductController::class, 'store']);
            Route::put('/products', [\App\Http\Controllers\Api\ProductController::class, 'update']);
            Route::delete('/products', [\App\Http\Controllers\Api\ProductController::class, 'destroy']);
            Route::get('/products/{product}', [\App\Http\Controllers\Api\ProductController::class, 'show']);

            Route::get('/staffs', [\App\Http\Controllers\Api\StaffController::class, 'index']);
            Route::post('/staffs', [\App\Http\Controllers\Api\StaffController::class, 'create']);
            Route::put('/staffs', [\App\Http\Controllers\Api\StaffController::class, 'update']);
            Route::delete('/staffs', [\App\Http\Controllers\Api\StaffController::class, 'destroy']);
            Route::get('/staffs/{staff}', [\App\Http\Controllers\Api\StaffController::class, 'show']);

            Route::get('/invoices', [\App\Http\Controllers\Api\InvoiceController::class, 'index']);
            Route::post('/invoices', [\App\Http\Controllers\Api\InvoiceController::class, 'store']);
            Route::put('/invoices', [\App\Http\Controllers\Api\InvoiceController::class, 'update']);
            Route::delete('/invoices', [\App\Http\Controllers\Api\InvoiceController::class, 'destroy']);
            Route::get('/invoices/{invoice}', [\App\Http\Controllers\Api\InvoiceController::class, 'show']);

            Route::get('/vouchers', [\App\Http\Controllers\Api\VoucherController::class, 'index']);
            Route::post('/vouchers', [\App\Http\Controllers\Api\VoucherController::class, 'store']);
            Route::put('/vouchers', [\App\Http\Controllers\Api\VoucherController::class, 'update']);
            Route::delete('/vouchers', [\App\Http\Controllers\Api\VoucherController::class, 'destroy']);
            Route::get('/vouchers/{voucher}', [\App\Http\Controllers\Api\VoucherController::class, 'show']);

            Route::get('/customers', [\App\Http\Controllers\Api\CustomerController::class, 'index']);
            Route::put('/customers', [\App\Http\Controllers\Api\CustomerController::class, 'update']);
            Route::delete('/customers', [\App\Http\Controllers\Api\CustomerController::class, 'destroy']);
            Route::get('/customers/{customer}', [\App\Http\Controllers\Api\CustomerController::class, 'show']);

            Route::post('/vouchers/verify', [\App\Http\Controllers\Api\VoucherVerifyController::class, '__invoke']);
        });

        Route::post('/customers', [\App\Http\Controllers\Api\CustomerController::class, 'store']);
        Route::get('/products', [\App\Http\Controllers\Api\ProductController::class, 'index']);
        Route::get('/invoices-pending', [\App\Http\Controllers\Api\InvoiceController::class, 'getPending']);
        Route::post('/invoices-finish/{invoice}', [\App\Http\Controllers\Api\InvoiceStatusController::class, 'finish']);
        Route::post('/invoices-undo/{invoice}', [\App\Http\Controllers\Api\InvoiceStatusController::class, 'undo']);

        Route::post('/logout', [AuthController::class, 'logout']);
    });

    Route::post('/signup', [AuthController::class, 'signup']);
    Route::post('/login', [AuthController::class, 'login']);
});
