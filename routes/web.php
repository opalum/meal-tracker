<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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
    Route::get('/', [DashboardController::class, 'showDailySummary'])->name('dashboard');

    Route::resource('users', UserController::class);

    Route::get('tickets', [TicketController::class, 'index'])->name('tickets.index');

    Route::get('/user/tickets', [TicketController::class, 'showAssignedTickets'])->name('user.tickets');
    Route::get('/user/tickets/assign', [TicketController::class, 'showRequestForm'])->name('user.tickets.show.assign');
    Route::post('/user/tickets/assign', [TicketController::class, 'handleRequest'])->name('user.tickets.assign');

    Route::get('/tickets/redeem', [TicketController::class, 'showRedeemForm'])->name('tickets.redeem.show');
    Route::post('/tickets/redeem', [TicketController::class, 'redeemTicket'])->name('tickets.redeem');

    Route::get('/tickets/report', [TicketController::class, 'showReportForm'])->name('tickets.report.form');
    Route::get('/tickets/report/generate', [TicketController::class, 'generateReport'])->name('tickets.report');

    Route::get('/tickets/report/single-date', [TicketController::class, 'generateSingleDateReport'])->name('tickets.report.single_date');
    Route::get('/tickets/report/date-range', [TicketController::class, 'generateDateRangeReport'])->name('tickets.report.date_range');

    Route::get('/user/tickets/select-monthly-report', function () {
        return view('user.select_monthly_report');
    })->name('user.tickets.select_monthly_report');
    Route::get('/user/tickets/monthly-report', [TicketController::class, 'monthlyReportForUser'])->name('user.tickets.monthly_report');
});

Route::get('login', [AuthController::class, 'show'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
