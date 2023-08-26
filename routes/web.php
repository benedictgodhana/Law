<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SubAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\DocumentController;

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

Route::get('/register', [AuthController::class, 'loadRegister']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', function () {
    return redirect('/');
});
Route::get('/', [AuthController::class, 'loadLogin']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout']);

// ********** Super Admin Routes *********
Route::group(['prefix' => 'super-admin', 'middleware' => ['web', 'isSuperAdmin']], function () {
    Route::get('/dashboard', [SuperAdminController::class, 'dashboard']);

    Route::get('/users', [SuperAdminController::class, 'users'])->name('superAdminUsers');
    Route::get('/manage-role', [SuperAdminController::class, 'manageRole'])->name('manageRole');
    Route::post('/update-role', [SuperAdminController::class, 'updateRole'])->name('updateRole');
});

// ********** Sub Admin Routes *********
Route::group(['prefix' => 'sub-admin', 'middleware' => ['web', 'isSubAdmin']], function () {
    Route::get('/dashboard', [SubAdminController::class, 'dashboard']);
    Route::get('/profile_information', [SubAdminController::class, 'profile_information']);
    Route::get('/clients', [SubAdminController::class, 'clients']);
    Route::get('/documents', [SubAdminController::class, 'documents']);
    Route::get('/cases', [SubAdminController::class, 'cases']);
    Route::get('/activities', [SubAdminController::class, 'activities']);
    Route::get('/settings', [SubAdminController::class, 'settings']);
    Route::get('/notes', [SubAdminController::class, 'notes']);
    Route::post('/clients', [SubAdminController::class, 'store'])->name('sub-admin.clients.store');
    Route::delete('/clients/{client}', [SubAdminController::class, 'destroy'])->name('sub-admin.clients.destroy');
    Route::get('/sub-admin/clients', [SubAdminController::class, 'store'])->name('sub-admin.clients');
    Route::put('/sub-admin/clients/{client}', [SubAdminController::class, 'update'])->name('sub-admin.clients.update');
    Route::get('/sub-admin/clients/pdf-report', [SubAdminController::class, 'generatePdfReport'])
        ->name('sub-admin.clients.pdf-report');

});

// ********** Admin Routes *********
Route::group(['prefix' => 'admin', 'middleware' => ['web', 'isAdmin']], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
});

// ********** User Routes *********
Route::group(['middleware' => ['web', 'isUser']], function () {
    Route::get('/dashboard', [UserController::class, 'dashboard']);
});


Route::get('/generate-client-report', [PdfController::class, 'generateClientReport'])
    ->name('generate.client.report');
Route::post('/upload-document', [DocumentController::class, 'uploadDocument'])->name('upload.document');