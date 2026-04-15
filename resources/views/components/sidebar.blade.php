<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-50 overflow-hidden">

    <div x-show="sidebarOpen" @click="sidebarOpen = false"
        class="fixed inset-0 z-20 bg-black bg-opacity-50 transition-opacity lg:hidden"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    </div>

    <aside
        class="fixed inset-y-0 left-0 z-30 w-64 bg-white border-r border-gray-200 flex flex-col transition-transform duration-300 transform lg:translate-x-0 lg:static lg:inset-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

        <div class="p-6 flex items-center justify-between">
            <h1 class="text-2xl font-black text-orange-600 tracking-tight">CMS</h1>
            <button @click="sidebarOpen = false" class="lg:hidden text-gray-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <nav class="flex-1 px-4 space-y-2 overflow-y-auto">
            <ul>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-4 px-4">Main Menu</p>
                <x-sidebar-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-layout-dashboard-icon lucide-layout-dashboard">
                        <rect width="7" height="9" x="3" y="3" rx="1" />
                        <rect width="7" height="5" x="14" y="3" rx="1" />
                        <rect width="7" height="9" x="14" y="12" rx="1" />
                        <rect width="7" height="5" x="3" y="16" rx="1" />
                    </svg>
                    <span>Dashboard</span>
                </x-sidebar-link>

                <x-sidebar-link :href="route('admin.packages')" :active="request()->routeIs('admin.packages')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-package-check-icon lucide-package-check">
                        <path d="M12 22V12" />
                        <path d="m16 17 2 2 4-4" />
                        <path
                            d="M21 11.127V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.729l7 4a2 2 0 0 0 2 .001l1.32-.753" />
                        <path d="M3.29 7 12 12l8.71-5" />
                        <path d="m7.5 4.27 8.997 5.148" />
                    </svg>
                    <span>Packages</span>
                </x-sidebar-link>
                <x-sidebar-link :href="route('admin.orders')" :active="request()->routeIs('admin.orders')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-calendar-arrow-up-icon lucide-calendar-arrow-up">
                        <path d="m14 18 4-4 4 4" />
                        <path d="M16 2v4" />
                        <path d="M18 22v-8" />
                        <path d="M21 11.343V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h9" />
                        <path d="M3 10h18" />
                        <path d="M8 2v4" />
                    </svg>
                    <span>Orders</span>
                </x-sidebar-link>
            </ul>
        </nav>

        <div class="p-4 border-t border-gray-100" x-data="{ loading: false }">
            <form action="{{ route('admin.logout') }}" method="POST" x-ajax
                @submit="if (!confirm('Are you sure you want to logout?')) $event.preventDefault()"
                @ajax:before="loading = true">
                @csrf
                <button type="submit" :disabled="loading"
                    class="flex items-center gap-3 w-full px-4 py-2 text-gray-500 hover:text-red-600 transition-colors disabled:opacity-50">
                    <svg x-show="!loading" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    <svg x-show="loading" class="animate-spin h-5 w-5 text-red-600" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <span class="font-medium" x-text="loading ? 'Logging out...' : 'Logout'"></span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
        <header class="flex items-center justify-between bg-white border-b border-gray-200 p-4">
            <div class="flex items-center">
                <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden mr-4">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <nav aria-label="Breadcrumb" class="flex">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        @foreach ($breadcrumbs as $label => $link)
                            <li class="inline-flex items-center">
                                @if (!$loop->first)
                                    <svg class="w-3 h-3 text-gray-400 mx-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg>
                                @endif

                                @if ($loop->last)
                                    <span class="text-sm font-bold text-gray-800">{{ $label }}</span>
                                @else
                                    <a href="{{ $link }}"
                                        class="text-sm font-medium text-gray-500 hover:text-orange-600 transition-colors">
                                        {{ $label }}
                                    </a>
                                @endif
                            </li>
                        @endforeach
                    </ol>
                </nav>
            </div>

            <div class="flex items-center space-x-4">
            </div>
        </header>

        <div class="flex-1 overflow-x-hidden overflow-y-auto p-4">
            {{ $slot }}
        </div>
    </main>
</div>
