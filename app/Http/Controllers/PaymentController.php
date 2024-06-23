<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function showInvoice()
    {
        $reservations = Reservation::with(['guest', 'ratePlan', 'bookings.payments'])
            ->get();

        $invoiceData = [];

        foreach ($reservations as $reservation) {
            foreach ($reservation->bookings as $booking) {
                foreach ($booking->payments as $payment) {
                    $invoiceData[] = [
                        'nama' => $reservation->guest->name,
                        'check_in' => $reservation->check_in,
                        'check_out' => $reservation->check_out,
                        'booking_date' => $reservation->booking_date,
                        'total_price' => $reservation->total_harga_room,
                    ];
                }
            }
        }

        return view('finance.invoice.index', ['invoiceData' => $invoiceData], ['title' => 'Invoice']);
    }

    public function showDetailedInvoice($guestId)
    {
        $reservation = Reservation::with(['guest', 'ratePlan', 'bookings.payments'])
            ->where('guest_id', $guestId)
            ->first();

        $detailedInvoiceData = [];

        if ($reservation) {
            foreach ($reservation->bookings as $booking) {
                foreach ($booking->payments as $payment) {
                    $detailedInvoiceData[] = [
                        'nama' => $reservation->guest->name,
                        'check_in' => $reservation->check_in,
                        'check_out' => $reservation->check_out,
                        'booking_date' => $reservation->booking_date,
                        'total_price' => $reservation->total_harga_room,
                        'tipe_room' => $reservation->ratePlan->name,
                        'harga_satuan' => $reservation->ratePlan->price,
                        'total' => $reservation->total_tamu * $reservation->check_out->diffInDays($reservation->check_in),
                        'total_harga' => $reservation->total_tamu * $reservation->check_out->diffInDays($reservation->check_in) * $reservation->ratePlan->price,
                    ];
                }
            }
        }

        return view('finance.invoice.detail', ['detailedInvoiceData' => $detailedInvoiceData]);
    }
}
