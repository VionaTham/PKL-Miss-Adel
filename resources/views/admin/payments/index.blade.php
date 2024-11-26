@extends('layouts.admin')

@section('title', 'Kelola Pembayaran')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold mb-6 text-gray-800">Kelola Pembayaran Peserta</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 mb-6 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
            <table class="min-w-full table-auto text-sm">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left">Nama Peserta</th>
                        <th class="px-6 py-3 text-left">Judul Seminar</th>
                        <th class="px-6 py-3 text-left">Status Pembayaran</th>
                        <th class="px-6 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($registrations as $registration)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-6 py-4">{{ $registration->user->name }}</td>
                            <td class="px-6 py-4">{{ $registration->event->title }}</td>
                            <td class="px-6 py-4">
                                @if ($registration->payment_status == 'Paid')
                                    <span class="bg-green-200 text-green-600 px-3 py-1 rounded-full text-xs font-medium">Pembayaran Selesai</span>
                                @else
                                    <span class="bg-yellow-200 text-yellow-600 px-3 py-1 rounded-full text-xs font-medium">Menunggu Pembayaran</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 flex space-x-4">
                                @if ($registration->payment_status == 'pending')
                                    <a href="{{ route('admin.payments.update', $registration->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">Konfirmasi Pembayaran</a>
                                @else
                                    <span class="text-gray-400">Terkonfirmasi</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
