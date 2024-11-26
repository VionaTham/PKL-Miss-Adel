@extends('layouts.app')

@section('title', 'Pendaftaran Seminar')

@section('content')
<section class="bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 py-16">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-extrabold text-center text-white mb-8">Registrasi untuk Seminar: {{ $event->title }}</h2>

        <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-2xl">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Pendaftaran Seminar</h3>

            <!-- Status Pembayaran -->
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Status Pembayaran</label>
                <p class="text-lg font-semibold text-blue-600">
                    {{ auth()->user()->registrations()->where('event_id', $event->id)->first()->payment_status ?? 'Pending' }}
                </p>
            </div>

            @php
                // Cek apakah pengguna sudah mendaftar
                $registration = auth()->user()->registrations()->where('event_id', $event->id)->first();
            @endphp

            <!-- Tombol Pembayaran jika statusnya pending -->
            @if($registration && $registration->payment_status == 'Pending')
                <div class="mb-6">
                    <form action="{{ route('payments.store', $event->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="payment_proof">Bukti Pembayaran</label>
                            <input type="file" name="payment_proof" id="payment_proof" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Bukti Pembayaran</button>
                    </form>
                </div>
            @elseif($registration && $registration->payment_status == 'Paid')
                <!-- Detail Seminar setelah pembayaran dilakukan -->
                <div class="mt-8 p-6 bg-gray-100 rounded-lg shadow-xl">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Detail Seminar</h3>
                    <p class="text-lg text-gray-700"><strong>Title:</strong> {{ $event->title }}</p>
                    <p class="text-lg text-gray-700"><strong>Tanggal:</strong> {{ $event->date }}</p>
                    <p class="text-lg text-gray-700"><strong>Lokasi:</strong> {{ $event->location }}</p>
                    <p class="text-lg text-gray-700"><strong>Jenis Seminar:</strong> {{ $event->type }}</p>
                    <p class="text-lg text-gray-700"><strong>Harga:</strong> Rp {{ number_format($event->price, 0, ',', '.') }}</p>

                    @if($registration && $registration->payment_status == 'Paid')
                        <div class="mt-6">
                            <p class="text-lg text-gray-700"><strong>Bukti Pembayaran:</strong></p>
                            <img src="{{ asset('storage/' . $registration->payment_proof) }}" alt="Bukti Pembayaran" class="mt-2 w-48 h-48 object-cover">
                        </div>
                    @else
                        <p class="text-lg text-gray-700 text-red-500 mt-4">Pembayaran belum dilakukan atau belum terkonfirmasi.</p>
                    @endif
                </div>

            @else
                <!-- Tombol Daftar Sekarang jika belum terdaftar -->
                <form action="{{ route('registrations.store', $event->id) }}" method="POST">
                    @csrf
                    <div class="text-center">
                        <button type="submit"
                            class="w-full py-3 bg-gradient-to-r from-indigo-500 to-blue-500 text-white font-bold rounded-lg shadow-lg hover:bg-gradient-to-l hover:from-indigo-600 hover:to-blue-600 focus:ring-2 focus:ring-indigo-500 transition duration-300 ease-in-out">
                            Daftar Sekarang
                        </button>
                    </div>
                </form>
            @endif

            <!-- Tombol Kembali -->
            <div class="mt-6 text-center">
                <a href="{{ url()->previous() }}"
                   class="inline-block py-3 px-8 bg-gradient-to-r from-purple-600 to-blue-600 text-white font-bold rounded-full shadow-xl hover:from-purple-700 hover:to-blue-700 focus:ring-4 focus:ring-purple-500 transition-all duration-300 ease-in-out transform hover:scale-105">
                   Kembali
                </a>
            </div>

        </div>
    </div>
</section>
@endsection