@extends('layouts.admin')

@section('title', 'Daftar Seminar')

@section('content')
    <div class="container mx-auto p-6 max-w-6xl">
        <h1 class="text-3xl font-bold text-center text-indigo-600 mb-6">Daftar Seminar</h1>

        <a href="{{ route('admin.events.create') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg mb-4 inline-block hover:bg-indigo-700 transition duration-200">
            Tambah Seminar Baru
        </a>

        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-indigo-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left">Judul</th>
                        <th class="px-6 py-3 text-left">Jenis</th>
                        <th class="px-6 py-3 text-left">Harga</th>
                        <th class="px-6 py-3 text-left">Tanggal</th>
                        <th class="px-6 py-3 text-left">Lokasi</th>
                        <th class="px-6 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800">
                    @foreach($events as $event)
                        <tr class="border-b hover:bg-gray-100 transition duration-200">
                            <td class="px-6 py-4">{{ $event->title }}</td>
                            <td class="px-6 py-4 capitalize">{{ $event->type }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($event->price, 2, ',', '.') }}</td>
                            <td class="px-4 py-2">
                                @if($event->date instanceof \Carbon\Carbon)
                                    {{ $event->date->format('d-m-Y') }}
                                @else
                                    {{ $event->date }}
                                @endif
                            </td>
                            <td class="px-6 py-4">{{ $event->location ?? '-' }}</td>
                            <td class="px-6 py-4 flex space-x-3">
                                <a href="{{ route('admin.events.edit', $event->id) }}" class="text-indigo-600 hover:text-indigo-800 transition duration-200">Edit</a>
                                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 transition duration-200">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
