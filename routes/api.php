<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\typesrepaircontroller;
use App\Http\Controllers\AdminData;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/ModelsData', [CompanyController::class, 'ModelsData'])->name("ModelsData");
Route::get('/TypesData', [typesrepaircontroller::class, 'TypesData'])->name("TypesData");
Route::get('/AdminDataOrders', [AdminData::class, 'DataOrders'])->name("DataOrders");
Route::get('/AdminDataQuest', [AdminData::class, 'DataQuest'])->name("DataQuest");
Route::get('/AdminDataCompany', [AdminData::class, 'DataCompany'])->name("DataCompany");
Route::get('/AdminDataModels', [AdminData::class, 'DataModels'])->name("DataModels");