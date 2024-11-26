<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Webinar</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-blue-800 text-white p-4">
            <h2 class="text-xl font-semibold">Admin Panel</h2>
            <ul class="mt-6">
                <li><a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 hover:bg-blue-700">Dashboard</a></li>
                <li><a href="{{ route('admin.events.index') }}" class="block py-2 px-4 hover:bg-blue-700">Manage
                        Events</a></li>
                <li><a href="{{ route('admin.payments.index') }}" class="block py-2 px-4 hover:bg-blue-700">Manage
                        Payments</a></li>
                <!-- Tambahkan menu lain di sini jika diperlukan -->
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <header class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-semibold text-gray-900">Admin Dashboard</h1>
                <div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-blue-600 hover:text-blue-900">Logout</button>
                    </form>
                </div>

            </header>

            <main>
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
