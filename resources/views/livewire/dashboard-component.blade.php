<div class="grid grid-cols-1 mt-6 mb-4 md:grid-cols-2 lg:grid-cols-4 gap-6  px-4 py-2 ">
    <!-- Total Users -->
    <div class="bg-blue-500 text-white p-6 rounded-lg shadow-lg">
        <h3 class="text-xl font-semibold">Total Users</h3>
        <p class="text-4xl">{{ $totalUsers }}</p>
    </div>

    <!-- Total Tickets -->
    <div class="bg-green-500 text-white p-6 rounded-lg shadow-lg">
        <h3 class="text-xl font-semibold">Total Tickets</h3>
        <p class="text-4xl">{{ $totalTickets }}</p>
    </div>

    <!-- Total Buses -->
    <div class="bg-yellow-500 text-white p-6 rounded-lg shadow-lg">
        <h3 class="text-xl font-semibold">Total Buses</h3>
        <p class="text-4xl">{{ $totalBuses }}</p>
    </div>

    <!-- Total Routes -->
    <div class="bg-red-500 text-white p-6 rounded-lg shadow-lg">
        <h3 class="text-xl font-semibold">Total Routes</h3>
        <p class="text-4xl">{{ $totalRoutes }}</p>
    </div>
</div>
