<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\EquipmentRentalController;
use App\Http\Controllers\BillsController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\InvoiceQuoteController;
use App\Http\Controllers\EmployeeExpenseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login/', [AuthController::class, 'login']);
Route::post('/register/', [AuthController::class, 'register']);

Route::group([
    'middleware' => 'api',
], function ($router) {

    Route::post('/logout/', [AuthController::class, 'logout']);
    Route::post('/refresh/', [AuthController::class, 'refresh']);
    Route::post('/me/', [AuthController::class, 'me']);

    //services
    Route::get('/services/', [ServicesController::class, 'index']);
    Route::get('/services/{id}/', [ServicesController::class, 'watch']);
    Route::post('/services/', [ServicesController::class, 'register']);
    Route::post('/services/{id}/', [ServicesController::class, 'update']);
    Route::delete('/services/{id}/', [ServicesController::class, 'delete']);

    //suppliers
    Route::get('/suppliers/', [SuppliersController::class, 'index']);
    Route::get('/suppliers/{id}/', [SuppliersController::class, 'watch']);
    Route::post('/suppliers/', [SuppliersController::class, 'register']);
    Route::post('/suppliers/{id}/', [SuppliersController::class, 'update']);
    Route::delete('/suppliers/{id}/', [SuppliersController::class, 'delete']);

    //equipment_rental
    Route::get('/equipment_rental/', [EquipmentRentalController::class, 'index']);
    Route::get('/equipment_rental/{id}/', [EquipmentRentalController::class, 'watch']);
    Route::post('/equipment_rental/', [EquipmentRentalController::class, 'register']);
    Route::post('/equipment_rental/{id}/', [EquipmentRentalController::class, 'update']);
    Route::delete('/equipment_rental/{id}/', [EquipmentRentalController::class, 'delete']);

    //bills
    Route::get('/bills/', [BillsController::class, 'index']);
    Route::get('/bills/{id}/', [BillsController::class, 'watch']);
    Route::post('/bills/', [BillsController::class, 'register']);
    Route::post('/bills/{id}/', [BillsController::class, 'update']);
    Route::delete('/bills/{id}/', [BillsController::class, 'delete']);

    //employees
    Route::get('/employees/', [EmployeesController::class, 'index']);
    Route::get('/employees/{id}/', [EmployeesController::class, 'watch']);
    Route::post('/employees/', [EmployeesController::class, 'register']);
    Route::post('/employees/{id}/', [EmployeesController::class, 'update']);
    Route::delete('/employees/{id}/', [EmployeesController::class, 'delete']);

    //invoice_quote
    Route::get('/invoice_quote/', [InvoiceQuoteController::class, 'index']);
    Route::get('/invoice_quote/{id}/', [InvoiceQuoteController::class, 'watch']);
    Route::post('/invoice_quote/', [InvoiceQuoteController::class, 'register']);
    Route::post('/invoice_quote/{id}/', [InvoiceQuoteController::class, 'update']);
    Route::delete('/invoice_quote/{id}/', [InvoiceQuoteController::class, 'delete']);

    //employee_expense
    Route::get('/employee_expense/', [EmployeeExpenseController::class, 'index']);
    Route::get('/employee_expense/{id}/', [EmployeeExpenseController::class, 'watch']);
    Route::post('/employee_expense/', [EmployeeExpenseController::class, 'register']);
    Route::post('/employee_expense/{id}/', [EmployeeExpenseController::class, 'update']);
    Route::delete('/employee_expense/{id}/', [EmployeeExpenseController::class, 'delete']);

    //dashboard
    Route::get('/dashboard/', [DashboardController::class, 'index']);

    //users
    Route::get('/users/', [UserController::class, 'index']);
    Route::get('/users/{id}/', [UserController::class, 'watch']);
    Route::post('/users/{id}/', [UserController::class, 'update']);
    Route::delete('/users/{id}/', [UserController::class, 'delete']);
    Route::post('/users/reset_password/{id}/', [UserController::class, 'reset_password']);

});
