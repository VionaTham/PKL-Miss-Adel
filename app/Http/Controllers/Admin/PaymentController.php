<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        // Ambil semua registrasi peserta beserta informasi pembayaran mereka
        $registrations = Registration::with(['user', 'event'])->get();

        return view('admin.payments.index', compact('registrations'));
    }

    // Mengonfirmasi pembayaran
    public function update(Registration $registration)
    {
        $registration->payment_status = 'Paid'; // Ubah status pembayaran menjadi 'paid'
        $registration->save(); // Simpan perubahan

        return redirect()->route('admin.payments.index')->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }

    public function store(Request $request, Event $event)
    {
        // Validasi file bukti pembayaran
        $request->validate([
            'payment_proof' => 'required|mimes:jpg,png,pdf|max:2048',
        ]);

        // Ambil data pengguna yang sedang login
        $user = Auth::user();

        // Cari registrasi pengguna untuk event ini
        $registration = Registration::where('user_id', $user->id)
            ->where('event_id', $event->id)
            ->firstOrFail(); // Jika tidak ada, akan lempar error

        // Cek apakah pembayaran sudah dilakukan
        if ($registration->payment_status == 'Paid') {
            return redirect()->back()->with('info', 'Pembayaran sudah dikonfirmasi.');
        }

        // Simpan bukti pembayaran
        $paymentProof = $request->file('payment_proof')->store('payment_proofs', 'public');

        // Update status pembayaran menjadi 'Paid'
        $registration->payment_status = 'Paid';
        $registration->payment_proof = $paymentProof;
        $registration->save();

        return redirect()->route('user.landing')->with('success', 'Pembayaran berhasil! Anda sudah terdaftar untuk seminar.');
    }

}