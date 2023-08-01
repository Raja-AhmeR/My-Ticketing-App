<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified', 'check-user'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get('/admin/new-agent', [UserController::class, 'index'])->name('admin.new-agent');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'check-user'])->prefix('admin')->name('admin.')->group(function () {
    // Routes For Agent Creation
    Route::get('/view-agent', [UserController::class, 'index'])->name('view-agent');
    Route::get('/new-agent', [UserController::class, 'create'])->name('create-agent');
    Route::post('/new-agent', [UserController::class, 'store'])->name('store-agent');
    Route::get('/delete-agent/{id}', [UserController::class, 'destroy'])->name('delete-agent');

    // Routes For Category
    Route::get('/category/view-category', [CategoryController::class, 'index'])->name('view-category');
    Route::get('/category/create-category', [CategoryController::class, 'create'])->name('create-category');
    Route::post('/category/create-category', [CategoryController::class, 'store'])->name('store-category');
    Route::get('/category/edit-category/{id}', [CategoryController::class, 'edit'])->name('edit-category');
    Route::put('/category/update-category/{id}', [CategoryController::class, 'update'])->name('update-category');
    Route::get('/category/delete-category/{id}', [CategoryController::class, 'destroy'])->name('delete-category');

    // Route for Label
    Route::get('label/view', [LabelController::class, 'index'])->name('view-label');
    Route::get('label/create', [LabelController::class, 'create'])->name('create-label');
    Route::post('label/create', [LabelController::class, 'store'])->name('store-label');
    Route::get('/label/edit-label/{id}', [LabelController::class, 'edit'])->name('edit-label');
    Route::put('/label/update-label/{id}', [LabelController::class, 'update'])->name('update-label');
    Route::get('/label/delete-label/{id}', [LabelController::class, 'destroy'])->name('delete-label');

    // Route for Roles
    Route::get('/role/view', [RoleController::class, 'index'])->name('role-view');

    //Route for Permissions
    Route::get('/permission/view', [PermissionController::class, 'index'])->name('permission-view');
    Route::post('/permission/update', [PermissionController::class, 'assignPermission'])->name('update-permission');
});

// Route for Ticket
Route::middleware(['auth', 'check-user'])->group(function() {
    Route::get('/ticket/view-ticket', [TicketController::class, 'index'])->name('view-ticket');
    Route::get('/ticket/create-ticket', [TicketController::class, 'create'])->name('create-ticket');
    Route::post('/ticket/create-ticket', [TicketController::class, 'store'])->name('store-ticket');
    Route::get('/ticket/{id}/show', [TicketController::class, 'show'])->name('show-ticket');
    Route::get('/ticket/edit-ticket/{id}', [TicketController::class, 'edit'])->name('edit-ticket');
    Route::post('/ticket/update-ticket/{id}', [TicketController::class, 'update'])->name('update-ticket');
    Route::get('/ticket/delete-ticket/{id}', [TicketController::class, 'destroy'])->name('delete-ticket');
    Route::post('/ticket/update', [TicketController::class, 'assignToAgent'])->name('assign-to-agent');
    Route::get('/ticket/logs', [TicketController::class, 'viewLog'])->name('ticket-log');

});

Route::get('/access', function() {
    return view('access');
});
