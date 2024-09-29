<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['customer_name', 'status']);

        $storeId = Auth()->user()->store_id;

        $bookings = $this->bookingService->getBookingByStore($filters, $storeId);

        return view('cashier.bookings.index', compact('bookings'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $result = $this->bookingService->updateBookingStatus($request, $booking);
        if (isset($result['error'])) {
            return redirect()->back()->with('error', $result['error']);
        }

        return redirect()->route('cashier.bookings.index')->with('success', $result['success']);
    }
}
