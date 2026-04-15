@php
    $navLinks = [
        'Dashboard' => '#',
    ];
@endphp

<x-layout.admin-app-layout title="Dashboard" :breadcrumbs="$navLinks">
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <div
                class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 p-5 transition-all hover:shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Packages</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-1">{{ $packageCount }}</h3>
                    </div>
                    <div class="p-3 bg-indigo-50 rounded-lg">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-emerald-500 font-semibold">+12%</span>
                    <span class="text-gray-400 ml-2">since last month</span>
                </div>
            </div>

            <div
                class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 p-5 transition-all hover:shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Bookings</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-1">{{ $bookingCount }}</h3>
                    </div>
                    <div class="p-3 bg-emerald-50 rounded-lg">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-emerald-500 font-semibold">+5.4%</span>
                    <span class="text-gray-400 ml-2">from yesterday</span>
                </div>
            </div>

        </div>
    </div>
</x-layout.admin-app-layout>
