@php
    $navLinks = [
        'Package Management' => '#',
    ];
@endphp

<x-layout.admin-app-layout title="Packages" :breadcrumbs="$navLinks">
    <div class="p-6 space-y-6" x-data="packageList()">

        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-black text-gray-900 tracking-tight">Packages</h1>
                <p class="text-sm text-gray-500">Manage your subscription plans and pricing.</p>
            </div>

            <a href="{{ route('admin.packages.create') }}"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Package
            </a>
        </div>

        <div class="bg-white overflow-hidden shadow-sm border border-gray-200 sm:rounded-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Package
                                Name</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Price
                            </th>
                            <th
                                class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($packages as $package)
                            <tr class="hover:bg-gray-50 transition-colors" x-ref="pkg_{{ $package->id }}">
                                {{-- ID Column --}}
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-900">{{ $package->id }}</div>
                                </td>

                                {{-- Package Name & Image Column --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-16 mr-4">
                                            @if ($package->image_path)
                                                <img class="h-10 w-16 rounded-md object-cover border border-gray-200"
                                                    src="{{ asset('storage/' . $package->image_path) }}"
                                                    alt="{{ $package->name }}">
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
                                        <div class="font-bold text-gray-900">{{ $package->name }}</div>
                                    </div>
                                </td>

                                {{-- Price Column --}}
                                <td class="px-6 py-4 text-sm text-gray-600 font-medium">
                                    ₱{{ number_format($package->price, 2) }}
                                </td>

                                {{-- Actions Column --}}
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('admin.packages.edit', $package->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900 text-sm font-semibold">
                                        Edit
                                    </a>
                                    <button
                                        @click="deletePackage({{ $package->id }}, '{{ addslashes($package->name) }}')"
                                        class="text-red-600 hover:text-red-900 text-sm font-semibold">
                                        Delete
                                    </button>
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
        function packageList() {
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
