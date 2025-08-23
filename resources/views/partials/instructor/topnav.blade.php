<header class="bg-white shadow p-4 flex justify-between items-center">
    <h1 class="text-xl font-semibold">Dashboard</h1>

    <div class="flex items-center space-x-4">
        <span class="text-gray-600">Hello, {{ auth()->user()->name }}</span>
        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}"
             alt="Avatar" class="w-8 h-8 rounded-full">
    </div>
</header>
