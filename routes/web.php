<?php

use App\Models\Unit;
use App\Models\Guest;
use App\Models\Inventory;
use App\Models\RatePlan;
use Illuminate\Support\Arr;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('dashboard', ['title' => 'Dashboard']);
});

// Rooms
Route::get('/rooms', function () {
    return view('rooms/index', ['title' => 'Rooms', 'rooms' => Inventory::all()]);
});

Route::get('/rooms/create', function () {
    return view('rooms/create', ['title' => 'Create Room']);
});

Route::get('/rooms/{room}', function (Inventory $room) {
    return view('rooms/show', ['title' => 'view room', 'room' => $room]);
});

// Guests
Route::get('/guests', function () {
    return view('guests/index', ['title' => 'Guests', 'guests' => Guest::all()]);
});

Route::get('/guests/create', function () {
    return view('guests/create', ['title' => 'Create Guest']);
});

Route::get('/guests/{guest}', function (Guest $guest) {
    return view('guests/show', ['title' => $guest->name, 'guest' => $guest,]);
});

// Reservations
Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');


Route::get('/reservations/show', function () {
    return view('reservations/show', ['title' => 'Show Reservations']);
});

Route::get('/reservations/group_bookings', function () {
    return view('reservations/groupbooking/index', ['title' => 'Group Booking']);
});



// Housekeeping
Route::get('/housekeeping', function () {
    return view('housekeeping/index', ['title' => 'Housekeeping']);
});

// Sales
Route::get('/sales/rate_plans', function () {
    $ratePlans = RatePlan::all();
    return view('sales.rateplans', ['title' => 'Rate Plans', 'ratePlans' => $ratePlans]);
});

Route::get('/sales/rate_plans/create', function () {
    return view('sales/create', ['title' => 'create']);
});

// Finance
Route::prefix('finance')->group(function () {
    Route::get('/invoice', [PaymentController::class, 'showInvoice'])->name('invoice.index');
    Route::get('/invoice/{guestId}/detail', [PaymentController::class, 'showDetailedInvoice'])->name('invoice.show');
    Route::get('/invoice/{guestId}/download', [PaymentController::class, 'downloadInvoice'])->name('invoice.download');
});

Route::get('/document_folios', function () {
    return view('finance/folios/index', ['title' => 'folios']);
});

// General Manager
