@extends('layouts.app')

@section('title', 'Landing Page')

@section('content')
    <!-- Carousel -->
    <section class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white mt-0">
        <div class="w-full">
            <div class="relative overflow-hidden">
                <div class="flex items-center justify-center h-[400px] bg-cover bg-center"
                    style="background-image:  url('{{ asset('assets/image/web2.jpeg') }}');">
                    <div class="text-center bg-black/50 p-8 rounded-lg">
                        <h1 class="text-5xl font-extrabold mb-4">Faith, Community, and Excellence</h1>
                        <p class="text-lg font-medium mb-6">Education in an environment of faith and virtue for Pre-K through
                            8th grade.</p>
                        <button
                            class="mt-6 bg-yellow-400 hover:bg-yellow-500 text-black font-semibold py-3 px-8 rounded-full shadow-lg transition-all duration-300 transform hover:scale-105">
                            Learn More
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Jadwal Seminar -->
<section class="bg-gradient-to-r from-blue-600 to-indigo-800 text-white py-16 text-center" id="seminar">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold mb-8">Jadwal Seminar Terbaru</h2>
        <p class="mb-8 text-lg font-light">Temukan seminar terbaru dan daftarkan diri Anda untuk memperluas wawasan dan keterampilan.</p>

        <!-- Tampilkan Daftar Event -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($events as $event)
                <div class="bg-white text-black rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:scale-105">
                    <!-- Header Card -->
                    <div class="bg-gradient-to-r from-indigo-500 via-purple-600 to-pink-500 p-6 text-center">
                        <h3 class="text-2xl font-semibold text-white">{{ $event->title }}</h3>
                        <p class="text-sm text-white mt-2">{{ ucfirst($event->type) }} Seminar</p>
                    </div>
                    <!-- Body Card -->
                    <div class="p-6">
                        <p class="text-lg mb-4">Tanggal: {{ \Carbon\Carbon::parse($event->date)->format('d-m-Y') }}</p>
                        <p class="text-lg mb-4">Harga: Rp {{ number_format($event->price, 2, ',', '.') }}</p>
                        <p class="mb-4 text-sm text-gray-600">{{ $event->location ?? 'Lokasi belum ditentukan' }}</p>

                        <!-- Tombol -->
                        @auth
                            <a href="{{ route('registrations.create', ['event' => $event->id]) }}"
                               class="block bg-yellow-400 hover:bg-yellow-500 text-black font-semibold py-3 px-8 rounded-full shadow-md transform transition-all duration-300">
                                @if(auth()->user()->registrations()->where('event_id', $event->id)->exists())
                                    @if(auth()->user()->registrations()->where('event_id', $event->id)->first()->payment_status == 'Paid')
                                        Lihat Seminar
                                    @else
                                        Bayar Sekarang
                                    @endif
                                @else
                                    Daftar Seminar
                                @endif
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="block bg-gray-400 hover:bg-gray-500 text-black font-semibold py-3 px-8 rounded-full shadow-md transform transition-all duration-300">
                                Login untuk Daftar
                            </a>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


<section class="bg-gradient-to-r from-blue-700 to-indigo-800 py-12 text-white" id="event">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center text-white mb-8">News and Events</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Event 1 -->
            <div class="bg-white p-6 shadow-lg rounded-lg transform transition-all hover:scale-105 hover:shadow-2xl text-black">
                <div class="h-56 bg-cover rounded-lg mb-4" style="background-image: url('{{ asset('assets/image/web1.jpg') }}');"></div>
                <h3 class="text-2xl font-bold mb-2 text-blue-600">Catholic High School Info Night</h3>
                <p class="text-gray-700 mb-4">October 3, 2024</p>
                <a href="#" class="text-yellow-400 font-semibold hover:underline transition-colors duration-300">Learn More</a>
            </div>
            <!-- Event 2 -->
            <div class="bg-white p-6 shadow-lg rounded-lg transform transition-all hover:scale-105 hover:shadow-2xl text-black">
                <div class="h-56 bg-cover rounded-lg mb-4" style="background-image: url('{{ asset('assets/image/web2.jpeg') }}');"></div>
                <h3 class="text-2xl font-bold mb-2 text-blue-600">Auction Procurement is Underway</h3>
                <p class="text-gray-700 mb-4">February 2, 2024</p>
                <a href="#" class="text-yellow-400 font-semibold hover:underline transition-colors duration-300">Learn More</a>
            </div>
            <!-- Event 3 -->
            <div class="bg-white p-6 shadow-lg rounded-lg transform transition-all hover:scale-105 hover:shadow-2xl text-black">
                <div class="h-56 bg-cover rounded-lg mb-4" style="background-image: url('{{ asset('assets/image/web3.jpg') }}');"></div>
                <h3 class="text-2xl font-bold mb-2 text-blue-600">5th Annual Trunk or Treat</h3>
                <p class="text-gray-700 mb-4">October 26, 2024</p>
                <a href="#" class="text-yellow-400 font-semibold hover:underline transition-colors duration-300">Learn More</a>
            </div>
        </div>
    </div>
</section>


@endsection