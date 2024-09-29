<?php

namespace App\Services;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingService
{
    const VALID_STATUSES = ['pending', 'confirmed', 'completed', 'cancelled'];

    public function getAllBookings($filters = [])
    {
        $query = Booking::with('user', 'store');

        if (! empty($filters['customer_name'])) {
            $query->where('name', 'like', '%'.$filters['customer_name'].'%');
        }

        if (! empty($filters['store_id'])) {
            $query->where('store_id', $filters['store_id']);
        }

        if (! empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->orderBy('created_at', 'desc')->paginate(10);
    }

    public function getBookingByStore($filters, $store)
    {
        $query = Booking::query()->where('store_id', $store);

        if (! empty($filters['customer_name'])) {
            $query->where('name', 'like', '%'.$filters['customer_name'].'%');
        }

        if (! empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->orderBy('created_at', 'desc')->paginate(10);
    }

    public function updateBookingStatus(Request $request, Booking $booking)
    {
        $status = $request->input('status');

        if (! in_array($status, self::VALID_STATUSES)) {
            return ['error' => 'Trạng thái không hợp lệ.'];
        }

        if ($booking->status === 'completed' && $status === 'cancelled') {
            return ['error' => 'Không thể hủy đơn hàng đã hoàn thành.'];
        }

        $currentStatusIndex = array_search($booking->status, self::VALID_STATUSES);
        $newStatusIndex = array_search($status, self::VALID_STATUSES);

        if ($newStatusIndex < $currentStatusIndex) {
            return ['error' => 'Không thể quay lại trạng thái trước.'];
        }

        $booking->status = $status;
        $booking->save();

        return ['success' => 'Trạng thái đã được cập nhật thành công.'];
    }

    public function cancelBooking(Booking $booking)
    {
        if ($booking->status == 'completed') {
            return ['error' => 'Không thể hủy đặt chỗ đã hoàn thành.'];
        }

        $booking->update(['status' => 'cancelled']);

        return ['success' => 'Đặt chỗ đã được hủy thành công.'];
    }

    public function getBookingsForCurrentStaff()
    {
        $staffId = auth()->user()->id;

        $bookings = Booking::where('user_id', $staffId)
            ->with('user', 'store')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return $bookings;
    }

    public function getBookingDetail($id)
    {
        return Booking::with('details')->findOrFail($id);
    }
}
