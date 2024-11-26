@extends('layouts.admin')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Welcome to the Admin Dashboard</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-blue-100 p-4 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-blue-700">Total Events</h3>
                <p class="text-gray-600 mt-2">{{ $eventCount }} Events</p>
            </div>

            <div class="bg-green-100 p-4 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-green-700">Registrations</h3>
                <p class="text-gray-600 mt-2">{{ $registrationCount }} Registrations</p>
            </div>

            <div class="bg-orange-100 p-4 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-orange-700">Pending Payments</h3>
                <p class="text-gray-600 mt-2">{{ $pendingPaymentsCount }} Pending</p>
            </div>
        </div>
    </div>
@endsection
