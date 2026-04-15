@php
    $navLinks = [
        'Booking Management' => '#',
    ];
@endphp

<x-layout.admin-app-layout title="Packages" :breadcrumbs="$navLinks">
    <div class="p-6 space-y-6" x-data="orderList()">

        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-black text-gray-900 tracking-tight">Bookings</h1>
                <p class="text-sm text-gray-500">Manage all the order of your client</p>
            </div>

            <div class="flex items-center space-x-2">
                <a href="{{ route('admin.orders.export') }}"
                    class="border border-gray-200 rounded-lg px-4 py-2 text-xs font-semibold text-gray-600 hover:bg-gray-50 hover:text-gray-900 focus:outline-none focus:bg-gray-50 focus:text-gray-900 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-file-down-icon lucide-file-down">
                        <path
                            d="M6 22a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h8a2.4 2.4 0 0 1 1.704.706l3.588 3.588A2.4 2.4 0 0 1 20 8v12a2 2 0 0 1-2 2z" />
                        <path d="M14 2v5a1 1 0 0 0 1 1h5" />
                        <path d="M12 18v-6" />
                        <path d="m9 15 3 3 3-3" />
                    </svg>
                    Export Records
                </a>

                <a href="{{ route('admin.orders.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Bookings
                </a>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm border border-gray-200 sm:rounded-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Client
                                Name</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Package
                            </th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Total
                                Price
                            </th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Total
                                Status
                            </th>
                            <th
                                class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($bookings as $booking)
                            <tr class="hover:bg-gray-50 transition-colors" x-ref="pkg_{{ $booking->id }}">
                                {{-- ID Column --}}
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-900">{{ $booking->id }}</div>
                                </td>

                                {{-- Client Name Column --}}
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-900">{{ $booking->fullname }}</div>
                                </td>

                                {{-- Package Name & Image Column --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-16 mr-4">
                                            @if ($booking->package->image_path)
                                                <img class="h-10 w-16 rounded-md object-cover border border-gray-200"
                                                    src="{{ asset('storage/' . $booking->package->image_path) }}"
                                                    alt="{{ $booking->package->name }}">
                                            @else
                                                <div
                                                    class="h-10 w-16 rounded-md bg-gray-100 flex items-center justify-center border border-gray-200">
                                                    <svg class="w-6 h-6 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="font-bold text-gray-900">{{ $booking->package->name }}</div>
                                    </div>
                                </td>

                                {{-- Price Column --}}
                                <td class="px-6 py-4 text-sm text-gray-600 font-medium">
                                    ₱{{ number_format($booking->total_price, 2) }}
                                </td>


                                {{-- Status Column --}}
                                <td class="px-6 py-4">
                                    <div
                                        class="text-sm font-medium uppercase 
                                    @if ($booking->status == 'pending') text-yellow-800
                                    @elseif ($booking->status == 'confirmed')
                                        text-green-600
                                    @elseif ($booking->status == 'cancelled')
                                        text-red-600    
                                    @elseif ($booking->status == 'completed')
                                        text-blue-600
                                    @else
                                        text-gray-600 @endif">
                                        {{ $booking->status }}
                                    </div>
                                </td>

                                {{-- Actions Column --}}
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('admin.orders.show', $booking->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900 text-sm font-semibold">
                                        View order
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-6 py-4 text-sm text-center text-gray-500" colspan="4">
                                    No packages found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function orderList() {
            return {
                async deletePackage(id, name) {
                    // 1. Native Browser Confirmation
                    if (!confirm(`Are you sure you want to delete "${name}"?`)) {
                        return;
                    }

                    try {
                        // 2. Send request to Laravel
                        // Note: Replace the URL with your actual route pattern
                        const url = `{{ route('admin.packages.destroy', ':id') }}`.replace(':id',
                            id);

                        const response = await axios.delete(url);

                        if (response.status === 200) {
                            // 3. Remove the row from the DOM using the x-ref
                            this.$refs[`pkg_${id}`].remove();

                            // Optional: show a small toast notification here
                            console.log('Deleted successfully');
                        }
                    } catch (error) {
                        alert('Something went wrong. Please try again.');
                        console.error(error);
                    }
                }
            }
        }
    </script>
</x-layout.admin-app-layout>
