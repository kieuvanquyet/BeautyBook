<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceService
{
    public function getBookingCountByDate($date, $storeId = '')
    {
        return Booking::whereDate('created_at', $date)->where('store_id', $storeId)->count('id');
    }

    public function getInvoiceCountByDate($date, $storeId = '')
    {
        return Invoice::whereDate('created_at', $date)->where('store_id', $storeId)->count('id');
    }

    public function getServiceCountByDate($date, $storeId = '')
    {
        return InvoiceDetail::whereDate('created_at', $date)
            ->whereHas('invoice', function ($query) use ($storeId) {
                $query->where('store_id', $storeId);
            })
            ->selectRaw('COUNT(DISTINCT service_id) as service_count')
            ->first()
        ->service_count;
    }

    public function getTotalRevenueByDate($date, $storeId = '')
    {
        return Invoice::whereDate('created_at', $date)->where('store_id', $storeId)->sum('total_amount');
    }

    public function getLatestInvoices($storeId = '')
    {
        return Invoice::query()
            ->select('id', 'created_at', 'total_amount', 'payment_method')
            ->where('store_id', $storeId)
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();
    }

    public function getInvoiceCount($storeId = '')
    {
        return Invoice::query()->where('store_id', $storeId)->count();
    }

    public function getServiceCount($storeId = '')
    {
        return InvoiceDetail::query()
            ->where('store_id', $storeId)
            ->groupBy('service_id')
            ->count();
    }

    public function storeInvoice(Request $request)
    {
        $cashier = Auth::user();

        $invoice = Invoice::create([
            'user_id' => $cashier->id,
            'store_id' => $cashier->store_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'payment_method' => $request->payment_method,
            'total_amount' => 0,
        ]);

        $totalAmount = 0;

        foreach ($request->services as $serviceData) {
            $service = Service::findOrFail($serviceData['id']);
            $quantity = $serviceData['quantity'];
            $price = $service->price;
            $totalPrice = $price * $quantity;

            InvoiceDetail::create([
                'invoice_id' => $invoice->id,
                'service_id' => $service->id,
                'quantity' => $quantity,
                'price' => $price,
                'total_price' => $totalPrice,
            ]);

            $totalAmount += $totalPrice;
        }

        $invoice->update(['total_amount' => $totalAmount]);

        return $invoice;
    }

    public function getServices()
    {
        return Service::select('id', 'name', 'price')->get();
    }

    public function getInvoices(Request $request, $storeId = '')
    {
        $query = Invoice::query()
            ->select('id', 'created_at', 'total_amount', 'payment_method')
            ->where('store_id', $storeId)
            ->orderBy('id', 'desc');

        // Lọc theo ngày
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }

        // Lọc theo mã hóa đơn
        if ($request->filled('id')) {
            $query->where('id', $request->input('id'));
        }

        // Phân trang
        $invoices = $query->paginate(10)->appends($request->except('page'));

        return $invoices;
    }

    public function deleteInvoice(Invoice $invoice)
    {
        $invoice->details()->delete();
        $invoice->delete();
    }
}
