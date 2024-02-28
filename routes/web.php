<?php

use App\Http\Controllers\AuthController;
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
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('users', UserController::class);

    Route::get('tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('tickets/generate', [TicketController::class, 'generate'])->name('tickets.generate');

    Route::get('/user/tickets', [TicketController::class, 'showAssignedTickets'])->name('user.tickets');
    Route::get('/user/tickets/assign', [TicketController::class, 'showRequestForm'])->name('user.tickets.show.assign');
    Route::post('/user/tickets/assign', [TicketController::class, 'handleRequest'])->name('user.tickets.assign');

    Route::get('/tickets/redeem', [TicketController::class, 'showRedeemForm'])->name('tickets.redeem.show');
    Route::post('/tickets/redeem', [TicketController::class, 'redeemTicket'])->name('tickets.redeem');
});

Route::get('login', [AuthController::class, 'show'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
