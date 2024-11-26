<!-- resources/views/admin/events/edit.blade.php -->
@extends('layouts.admin')

@section('title', 'Edit Seminar')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold mb-6">Edit Seminar</h1>

        <form action="{{ route('admin.events.update', $event->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="flex flex-col">
                <label for="title" class="text-lg font-medium">Judul Seminar</label>
                <input type="text" id="title" name="title" value="{{ $event->title }}" class="border border-gray-300 rounded-lg p-3 mt-2" required>
            </div>

            <div class="flex flex-col">
                <label for="type" class="text-lg font-medium">Jenis Seminar</label>
                <select id="type" name="type" class="border border-gray-300 rounded-lg p-3 mt-2" required>
                    <option value="online" {{ $event->type == 'online' ? 'selected' : '' }}>Online</option>
                    <option value="offline" {{ $event->type == 'offline' ? 'selected' : '' }}>Offline</option>
                    <option value="workshop" {{ $event->type == 'workshop' ? 'selected' : '' }}>Workshop</option>
                </select>
            </div>

            <div class="flex flex-col">
                <label for="price" class="text-lg font-medium">Harga Seminar</label>
                <input type="number" id="price" name="price" value="{{ $event->price }}" class="border border-gray-300 rounded-lg p-3 mt-2" step="0.01" required>
            </div>

            <div class="flex flex-col">
                <label for="date" class="text-lg font-medium">Tanggal Seminar</label>
                <input type="date" id="date" name="date" value="{{ $event->date }}" class="border border-gray-300 rounded-lg p-3 mt-2" required>
            </div>

            <div class="flex flex-col">
                <label for="location" class="text-lg font-medium">Lokasi (Opsional)</label>
                <input type="text" id="location" name="location" value="{{ $event->location }}" class="border border-gray-300 rounded-lg p-3 mt-2">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg">Update Seminar</button>
        </form>
    </div>
@endsection
