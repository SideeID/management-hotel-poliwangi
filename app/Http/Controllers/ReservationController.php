<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Guest;
use App\Models\RatePlan;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::all();
        return view('reservations.index', ['title' => 'Reservations', 'reservations' => $reservations]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $guests = Guest::all();
        $ratePlans = RatePlan::all();
        return view('reservations.create', ['title' => 'Create Reservations'], compact('guests', 'ratePlans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'rate_plan_id' => 'required|exists:rate_plans,id',
            'booking_date' => 'required|date',
        ]);

        Reservation::create($request->all());

        return redirect()->route('reservations.index')->with('success', 'Reservation added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        $guests = Guest::all();
        $ratePlans = RatePlan::all();
        return view('reservations.edit', compact('reservation', 'guests', 'ratePlans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'rate_plan_id' => 'required|exists:rate_plans,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'booking_date' => 'required|date',
        ]);

        $reservation->update($validated);

        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Temukan data reservasi berdasarkan ID
        $reservation = Reservation::find($id);

        // Periksa jika reservasi ditemukan
        if ($reservation) {
            // Hapus data reservasi
            $reservation->delete();

            // Redirect atau berikan respons sesuai kebutuhan aplikasi Anda
            return redirect()->back()->with('success', 'Reservation deleted successfully');
        } else {
            // Redirect atau berikan respons jika reservasi tidak ditemukan
            return redirect()->back()->with('error', 'Reservation not found');
        }
    }
}
