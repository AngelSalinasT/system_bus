<div class="grid grid-cols-1 mt-6 mb-4 md:grid-cols-2 lg:grid-cols-4 gap-6 px-4 py-2">
    <!-- Total Users -->
    <div class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white p-6 rounded-lg shadow-lg hover:scale-105 transition-transform duration-300">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-semibold">Total Users</h3>
            <!-- Ícono más grande y mejor centrado -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
              </svg>
        </div>
        <p class="text-5xl font-bold mt-4">{{ $totalUsers }}</p>
    </div>

    <!-- Total Tickets -->
    <div class="bg-gradient-to-r from-green-500 to-teal-500 text-white p-6 rounded-lg shadow-lg hover:scale-105 transition-transform duration-300">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-semibold">Total Tickets</h3>
            <!-- Ícono más grande y mejor centrado -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
              </svg>

        </div>
        <p class="text-5xl font-bold mt-4">{{ $totalTickets }}</p>
    </div>

    <!-- Total Buses -->
    <div class="bg-gradient-to-r from-yellow-500 to-orange-500 text-white p-6 rounded-lg shadow-lg hover:scale-105 transition-transform duration-300">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-semibold">Total Buses</h3>
            <!-- Ícono más grande y mejor centrado -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                <path d="M8.5 19V21.2C8.5 21.48 8.5 21.62 8.4455 21.727C8.39757 21.8211 8.32108 21.8976 8.227 21.9455C8.12004 22 7.98003 22 7.7 22H5.8C5.51997 22 5.37996 22 5.273 21.9455C5.17892 21.8976 5.10243 21.8211 5.0545 21.727C5 21.62 5 21.48 5 21.2V19M19 19V21.2C19 21.48 19 21.62 18.9455 21.727C18.8976 21.8211 18.8211 21.8976 18.727 21.9455C18.62 22 18.48 22 18.2 22H16.3C16.02 22 15.88 22 15.773 21.9455C15.6789 21.8976 15.6024 21.8211 15.5545 21.727C15.5 21.62 15.5 21.48 15.5 21.2V19M3 12H21M3 5.5H21M6.5 15.5H8M16 15.5H17.5M7.8 19H16.2C17.8802 19 18.7202 19 19.362 18.673C19.9265 18.3854 20.3854 17.9265 20.673 17.362C21 16.7202 21 15.8802 21 14.2V6.8C21 5.11984 21 4.27976 20.673 3.63803C20.3854 3.07354 19.9265 2.6146 19.362 2.32698C18.7202 2 17.8802 2 16.2 2H7.8C6.11984 2 5.27976 2 4.63803 2.32698C4.07354 2.6146 3.6146 3.07354 3.32698 3.63803C3 4.27976 3 5.11984 3 6.8V14.2C3 15.8802 3 16.7202 3.32698 17.362C3.6146 17.9265 4.07354 18.3854 4.63803 18.673C5.27976 19 6.11984 19 7.8 19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <p class="text-5xl font-bold mt-4">{{ $totalBuses }}</p>
    </div>

    <!-- Total Routes -->
    <div class="bg-gradient-to-r from-red-500 to-pink-500 text-white p-6 rounded-lg shadow-lg hover:scale-105 transition-transform duration-300">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-semibold">Total Routes</h3>
            <!-- Ícono más grande y mejor centrado -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8"">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724a2 2 0 01-.894-2.632L7.055 9.724a2 2 0 011.789-1.053h6.312a2 2 0 011.788 1.053l4.396 5.56a2 2 0 01-.894 2.632L15 20H9z"></path>
            </svg>
        </div>
        <p class="text-5xl font-bold mt-4">{{ $totalRoutes }}</p>
    </div>
</div>
