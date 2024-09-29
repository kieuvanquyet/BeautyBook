<?php

use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Booking\OpeningStoreController;
use App\Http\Controllers\Cashier\BookingController as CashierBookingController;
use App\Http\Controllers\Cashier\HomeController;
use App\Http\Controllers\Cashier\InvoiceController;
use App\Http\Controllers\Cashier\ReportController;
use App\Http\Controllers\Cashier\ServiceController as CashierServiceController;
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

// Example Routes
Route::view('/pages/slick', 'pages.slick');
Route::view('/pages/datatables', 'pages.datatables');
Route::view('/pages/blank', 'pages.blank');

Route::get('/', function () {
    return redirect()->route('login');
})->middleware('guest');

Route::prefix('login')->middleware('guest')->group(function () {
    Route::view('/', 'auth.login')->name('login');
    Route::post('/', [AuthController::class, 'login'])->name('login.post');
});

Route::post('logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::prefix('admin')
    ->as('admin.')
    ->middleware(['auth'])
    ->group(function () {
        // Dashboard
        Route::get('/', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::middleware('role:manager')->group(function () {
            // STORES
            Route::resource('stores', StoreController::class);
            Route::get('/edit/{id}', [StoreController::class, 'editInforStore'])->name('stores.edit_infor'); //show store
            Route::put('/update/{id}', [StoreController::class, 'updateInfor'])->name('stores.update_infor'); //Edit store information in show
            Route::get('/{store}/staffs', [StoreController::class, 'showStoreStaffs'])->name('store.staffs');
            Route::get('opening-store/{id}', [OpeningStoreController::class, 'index'])->name('opening-store');
            Route::post('add-opening-store/{id}', [OpeningStoreController::class, 'store'])->name('add-opening-store');
            Route::put('update-opening-store/{storeId}/store_schedules/{id}', [OpeningStoreController::class, 'update'])->name('update-opening-store');
            Route::delete('delete-opening-store/{storeId}/store_schedules/{id}', [OpeningStoreController::class, 'destroy'])->name('delete-opening-store');

            // USERS
            Route::resource('users', UserController::class);

            // CATEGORIES
            Route::resource('categories', CategoryController::class);

            // BOOKINGS
            Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
            Route::put('bookings/update/{booking}', [BookingController::class, 'updateStatus'])->name('bookings.update');
            Route::post('bookings/cancel/{booking}', [BookingController::class, 'cancel'])->name('bookings.cancel');
        });
        Route::middleware('role:staff')->group(function () {
            Route::get('staff/bookings', [BookingController::class, 'showBookingsForStaff'])->name('staff.bookings');
        });
    });

Route::prefix('cashier')
    ->as('cashier.')
    ->middleware(['cashier'])
    ->group(function () {
        Route::match(['get', 'post'], '/', [HomeController::class, 'index'])->name('dashboard');

        Route::prefix('invoices')->as('invoices.')->group(function () {
            Route::get('/', [InvoiceController::class, 'index'])->name('index');

            Route::get('/create', [InvoiceController::class, 'create'])->name('create');
            Route::post('/store', [InvoiceController::class, 'store'])->name('store');

            Route::get('/detail/{invoice}', [InvoiceController::class, 'show'])->name('detail');

            Route::delete('destroy/{invoice}', [InvoiceController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('report')->as('report.')->group(function () {
            Route::get('/', [ReportController::class, 'index'])->name('index');
        });

        Route::get('/services', [CashierServiceController::class, 'index'])->name('services');

        Route::prefix('bookings')->as('bookings.')->group(function () {
            Route::get('/', [CashierBookingController::class, 'index'])->name('index');
            Route::put('/update/{booking}', [CashierBookingController::class, 'updateStatus'])->name('update');
        });
    });
