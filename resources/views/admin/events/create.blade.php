<!-- resources/views/admin/events/create.blade.php -->
@extends('layouts.admin')

@section('title', 'Tambah Seminar Baru')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold mb-6">Tambah Seminar Baru</h1>

        <form action="{{ route('admin.events.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="flex flex-col">
                <label for="title" class="text-lg font-medium">Judul Seminar</label>
                <input type="text" id="title" name="title" class="border border-gray-300 rounded-lg p-3 mt-2" required>
            </div>

            <div class="flex flex-col">
                <label for="type" class="text-lg font-medium">Jenis Seminar</label>
                <select id="type" name="type" class="border border-gray-300 rounded-lg p-3 mt-2" required>
                    <option value="online">Online</option>
                    <option value="offline">Offline</option>
                    <option value="workshop">Workshop</option>
                </select>
            </div>

            <div class="flex flex-col">
                <label for="price" class="text-lg font-medium">Harga Seminar</label>
                <input type="number" id="price" name="price" class="border border-gray-300 rounded-lg p-3 mt-2" step="0.01" required>
            </div>

            <div class="flex flex-col">
                <label for="date" class="text-lg font-medium">Tanggal Seminar</label>
                <input type="date" id="date" name="date" class="border border-gray-300 rounded-lg p-3 mt-2" required>
            </div>

            <div class="flex flex-col">
                <label for="location" class="text-lg font-medium">Lokasi (Opsional)</label>
                <input type="text" id="location" name="location" class="border border-gray-300 rounded-lg p-3 mt-2">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg">Simpan Seminar</button>
        </form>
    </div>
@endsection
