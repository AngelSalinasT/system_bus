<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Routes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <!-- Contenedor con padding horizontal -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Ajustamos el max-width de este div si es necesario -->
                <div class="w-full px-6">
                    @livewire('route-component')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


