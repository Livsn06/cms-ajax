@php
    $navLinks = [
        'Booking Management' => route('admin.orders'),
        'Booking Details' => route('admin.orders.show', $booking->id),
        'Edit Booking' => '#',
    ];
@endphp

<x-layout.admin-app-layout title="Edit Booking" :breadcrumbs="$navLinks">

    <div class="p-6" x-data="bookingForm({
        fullname: '{{ $booking->fullname }}',
        phone: '{{ $booking->phone }}',
        package_id: '{{ $booking->package->id }}',
        event_date: '{{ $booking->event_date }}',
        guest_count: {{ $booking->guest_count }},
        status: '{{ $booking->status }}'
    }, {{ $booking->package->price ?? 0 }})">

        <div x-show="showSuccess" x-cloak x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            class="flex items-center p-4 mb-6 text-green-800 rounded-lg bg-green-50 border border-green-200"
            role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <div class="ms-3 text-sm font-bold">Booking updated successfully!</div>
            <button type="button" @click="showSuccess = false"
                class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>

        <div class="flex items-center justify-between mb-8">
            <div class="space-y-1">
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Edit Booking #{{ $booking->id }}</h1>
                <p class="text-base font-normal text-gray-500">Update event details and status for this client.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            <div class="xl:col-span-2">
                <form @submit.prevent="submitForm" class="bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-6 sm:col-span-3">
                                <label class="block mb-2 text-sm font-bold text-gray-700">Client Full Name</label>
                                <input type="text" x-model="formData.fullname"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 block w-full p-3 transition-all outline-none"
                                    :class="errors.fullname ? 'border-red-500 bg-red-50' : 'border-gray-300'" required>
                                <p x-show="errors.fullname" x-text="errors.fullname ? errors.fullname[0] : ''"
                                    class="mt-2 text-sm text-red-600 font-medium"></p>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label class="block mb-2 text-sm font-bold text-gray-700">Phone Number</label>
                                <input type="tel" x-model="formData.phone"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 block w-full p-3 transition-all outline-none"
                                    :class="errors.phone ? 'border-red-500 bg-red-50' : 'border-gray-300'" required>
                                <p x-show="errors.phone" x-text="errors.phone ? errors.phone[0] : ''"
                                    class="mt-2 text-sm text-red-600 font-medium"></p>
                            </div>

                            <div class="col-span-6">
                                <label class="block mb-2 text-sm font-bold text-gray-700">Select Package</label>
                                <select x-model="formData.package_id" @change="updatePackagePrice"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 block w-full p-3 transition-all outline-none"
                                    :class="errors.package_id ? 'border-red-500 bg-red-50' : 'border-gray-300'"
                                    required>
                                    <option value="">Choose a package...</option>
                                    @foreach ($packages as $package)
                                        <option value="{{ $package->id }}" data-price="{{ $package->price }}">
                                            {{ $package->name }} (₱{{ number_format($package->price, 2) }}/head)
                                        </option>
                                    @endforeach
                                </select>
                                <p x-show="errors.package_id" x-text="errors.package_id ? errors.package_id[0] : ''"
                                    class="mt-2 text-sm text-red-600 font-medium"></p>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label class="block mb-2 text-sm font-bold text-gray-700">Event Date</label>
                                <input type="date" x-model="formData.event_date"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 block w-full p-3 transition-all outline-none"
                                    :class="errors.event_date ? 'border-red-500 bg-red-50' : 'border-gray-300'"
                                    required>
                                <p x-show="errors.event_date" x-text="errors.event_date ? errors.event_date[0] : ''"
                                    class="mt-2 text-sm text-red-600 font-medium"></p>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label class="block mb-2 text-sm font-bold text-gray-700">Guest Count</label>
                                <input type="number" x-model="formData.guest_count" min="1"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 block w-full p-3 transition-all outline-none"
                                    :class="errors.guest_count ? 'border-red-500 bg-red-50' : 'border-gray-300'"
                                    required>
                                <p x-show="errors.guest_count" x-text="errors.guest_count ? errors.guest_count[0] : ''"
                                    class="mt-2 text-sm text-red-600 font-medium"></p>
                            </div>

                            <div class="col-span-6">
                                <label class="block mb-2 text-sm font-bold text-gray-700">Booking Status</label>
                                <select x-model="formData.status"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 block w-full p-3 transition-all outline-none">
                                    <option value="pending">Pending</option>
                                    <option value="confirmed">Confirmed</option>
                                    <option value="cancelled">Cancelled</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <div
                        class="p-6 border-t border-gray-100 bg-gray-50/50 rounded-b-xl flex items-center justify-end space-x-4">
                        <a href="{{ route('admin.orders') }}"
                            class="text-gray-600 hover:text-orange-600 text-sm font-bold transition-colors">Cancel</a>
                        <button type="submit" :disabled="loading"
                            class="text-white bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-200 font-bold rounded-lg text-sm px-6 py-3 text-center inline-flex items-center transition-all disabled:opacity-50">
                            <svg x-show="loading" class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" fill="none"
                                viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <span x-text="loading ? 'Updating...' : 'Update Booking'"></span>
                        </button>
                    </div>
                </form>
            </div>

            <div class="xl:col-span-1">
                <div class="p-6 bg-slate-900 text-white rounded-xl shadow-sm space-y-6">
                    <h3 class="text-lg font-bold text-orange-500">Pricing Summary</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between border-b border-slate-700 pb-2">
                            <span class="text-slate-400 text-sm">Package Price</span>
                            <span class="font-bold">₱<span
                                    x-text="Number(selectedPrice).toLocaleString()"></span></span>
                        </div>
                        <div class="flex justify-between border-b border-slate-700 pb-2">
                            <span class="text-slate-400 text-sm">Guests</span>
                            <span class="font-bold" x-text="formData.guest_count || 0"></span>
                        </div>
                        <div class="flex justify-between items-center pt-2">
                            <span class="text-slate-300 font-bold">Total Price</span>
                            <span class="text-2xl font-black text-orange-500">₱<span
                                    x-text="calculateTotal()"></span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function bookingForm(initialData, initialPrice) {
            return {
                formData: initialData,
                selectedPrice: initialPrice,
                errors: {},
                loading: false,
                showSuccess: false,

                updatePackagePrice(e) {
                    const selectedOption = e.target.options[e.target.selectedIndex];
                    this.selectedPrice = selectedOption.getAttribute('data-price') || 0;
                },

                calculateTotal() {
                    const total = this.formData.guest_count * this.selectedPrice;
                    return total.toLocaleString(undefined, {
                        minimumFractionDigits: 2
                    });
                },

                async submitForm() {
                    this.loading = true;
                    this.errors = {};
                    this.showSuccess = false;

                    const payload = {
                        ...this.formData,
                        total_price: this.formData.guest_count * this.selectedPrice,
                        _method: 'PUT'
                    };

                    try {
                        await axios.post("{{ route('admin.orders.update', $booking->id) }}", payload);
                        this.showSuccess = true;
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                        setTimeout(() => this.showSuccess = false, 5000);
                    } catch (error) {
                        if (error.response && error.response.status === 422) {
                            this.errors = error.response.data.errors;
                        }
                    } finally {
                        this.loading = false;
                    }
                }
            }
        }
    </script>
</x-layout.admin-app-layout>
