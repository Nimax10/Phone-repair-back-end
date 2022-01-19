<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataPostController;
use App\Http\Controllers\AdminData;
use App\Http\Controllers\AuthController;

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

// Route::get('/', function () {
//     return view('index');
// });
Route::get('/', [CompanyController::class, 'index'])->name("index");

Route::get('/test', [CompanyController::class, 'test'])->name("test");

Route::POST('repair/order', [DataPostController::class, 'Order'])->name("Order");

Route::POST('repair/question', [DataPostController::class, 'Question'])->name("Question");


Route::get('/repair/auth', [AuthController::class, 'Auth'])->name('Auth');

Route::POST('/repair/check', [AuthController::class, 'CheckAuth'])->name('CheckAuth');

Route::middleware(['admin'])->group(function() {
    Route::get('/repair/auth/admin', [AdminData::class, 'Admin'])->name("admin");


    Route::POST('/repair/auth/admin/order_editOrDelete', [AdminData::class, 'order_editOrDelete'])->name("order_editOrDelete");

    Route::POST('/repair/auth/admin/question_editOrDelete', [AdminData::class, 'question_editOrDelete'])->name("question_editOrDelete");


    Route::POST('/repair/auth/admin/company_editOrDelete', [AdminData::class, 'company_editOrDelete'])->name("company_editOrDelete");
    Route::POST('/repair/auth/admin/company_create', [AdminData::class, 'company_create'])->name("company_create");

    Route::POST('/repair/auth/admin/model_editOrDelete', [AdminData::class, 'model_editOrDelete'])->name("model_editOrDelete");
    Route::POST('/repair/auth/admin/model_create', [AdminData::class, 'model_create'])->name("model_create");
    Route::POST('/repair/auth/admin/admin_create', [AdminData::class, 'admin_create'])->name('admin_create');
});
