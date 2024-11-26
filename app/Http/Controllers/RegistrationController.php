<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */public function create(Event $event)
{
    // Periksa apakah event ditemukan
    if (!$event) {
        return redirect()->route('user.landing')->with('error', 'Event tidak ditemukan.');
    }

    // Tampilkan form registrasi dengan data event
    return view('user.regis', compact('event'));
}

    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request, Event $event)
     {
         // Pastikan pengguna sudah login
         if (!Auth::check()) {
             return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
         }

         // Periksa jika event ditemukan
         if (!$event) {
             return redirect()->route('user.landing')->with('error', 'Event tidak ditemukan.');
         }

         $userId = Auth::id();

         // Cek apakah pengguna sudah terdaftar di event ini
         $registration = Registration::where('user_id', $userId)
                                      ->where('event_id', $event->id)
                                      ->first();

         if ($registration) {
             return redirect()->route('user.landing')->with('error', 'Anda sudah terdaftar untuk event ini.');
         }

         // Simpan data registrasi
         $registration = Registration::create([
             'user_id' => $userId,          // Ambil user_id dari pengguna yang terautentikasi
             'event_id' => $event->id,      // ID event yang didaftarkan
             'payment_status' => 'Pending', // Status pembayaran default
             'payment_proof' => null,       // Tidak ada bukti pembayaran untuk sementara
         ]);

         // Redirect setelah sukses, sertakan ID pendaftaran untuk menampilkan tombol Bayar Sekarang
         return redirect()->route('seminar.register', ['event' => $event->id])->with('success', 'Pendaftaran berhasil! Silakan unggah bukti pembayaran.');
     }

     public function pay(Event $event)
     {
         // Pastikan event ada
         if (!$event) {
             return redirect()->route('user.landing')->with('error', 'Event tidak ditemukan.');
         }

         // Pastikan pengguna sudah login
         if (!Auth::check()) {
             return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
         }

         // Cari registrasi pengguna untuk event ini
         $registration = Registration::where('user_id', Auth::id())->where('event_id', $event->id)->first();

         // Periksa apakah registrasi ada dan status pembayaran masih pending
         if ($registration && $registration->payment_status == 'Pending') {
             // Update status pembayaran menjadi 'paid'
             $registration->payment_status = 'Paid';
             $registration->save();

             return redirect()->route('user.landing')->with('success', 'Pembayaran berhasil dilakukan.');
         }

         return redirect()->route('user.landing')->with('error', 'Pendaftaran atau pembayaran sudah dilakukan sebelumnya.');
     }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}