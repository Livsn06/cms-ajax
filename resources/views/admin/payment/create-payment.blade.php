@php
    $navLinks = [
        'Booking Management' => route('admin.orders'),
        'Booking Details' => route('admin.orders.show', $booking->id),
        'Record Payment' => '#',
    ];

    $totalPaid = $booking->payments->sum('amount');
    $remainingBalance = $booking->total_price - $totalPaid;
@endphp

<x-layout.admin-app-layout title="Record Payment" :breadcrumbs="$navLinks">

    <div class="p-6" x-data="paymentForm({
        booking_id: {{ $booking->id }},
        remaining: {{ $remainingBalance }}
    })">

        <div x-show="showSuccess" x-cloak x-transition
            class="flex items-center p-4 mb-6 text-green-800 rounded-lg bg-green-50 border border-green-200"
            role="alert">
            <svg class="flex-shrink-0 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <div class="ms-3 text-sm font-bold">Payment recorded successfully!</div>
            <button type="button" @click="showSuccess = false"
                class="ms-auto bg-green-50 text-green-500 p-1.5 hover:bg-green-200 rounded-lg">
                <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>

        <div class="flex items-center justify-between mb-8">
            <div class="space-y-1">
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Record Payment</h1>
                <p class="text-base font-normal text-gray-500">Add a transaction for
                    <strong>{{ $booking->fullname }}</strong> (Booking #{{ $booking->id }})
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            <div class="xl:col-span-2">
                <form @submit.prevent="submitForm"
                    class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-6">
                                <label class="block mb-2 text-sm font-bold text-gray-700">Payment Method</label>
                                <select x-model="formData.payment_method"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 block w-full p-3 outline-none transition-all"
                                    :class="errors.payment_method ? 'border-red-500 bg-red-50' : ''" required>
                                    <option value="">Select Method</option>
                                    <option value="Cash">Cash</option>
                                    <option value="GCash">GCash</option>
                                    <option value="Bank Transfer">Bank Transfer</option>
                                    <option value="Credit Card">Credit Card</option>
                                </select>
                                <p x-show="errors.payment_method" x-text="errors.payment_method?.[0]"
                                    class="mt-2 text-sm text-red-600 font-medium"></p>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label class="block mb-2 text-sm font-bold text-gray-700">Amount Paid</label>
                                <div class="relative">
                                    <span
                                        class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 font-bold">₱</span>
                                    <input type="number" step="0.01" x-model.number="formData.amount"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 block w-full pl-8 p-3 outline-none transition-all"
                                        :class="(errors.amount || isOverpaying) ? 'border-red-500 bg-red-50' : ''"
                                        required>
                                </div>
                                <p x-show="isOverpaying" class="mt-2 text-sm text-red-600 font-bold flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Amount exceeds the payable balance!
                                </p>
                                <p x-show="errors.amount" x-text="errors.amount?.[0]"
                                    class="mt-2 text-sm text-red-600 font-medium"></p>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label class="block mb-2 text-sm font-bold text-gray-700">Payment Classification</label>
                                <select x-model="formData.status"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 block w-full p-3 outline-none transition-all">
                                    <option value="unpaid">Unpaid</option>
                                    <option value="partially_paid">Partially Paid</option>
                                    <option value="fully_paid">Fully Paid</option>
                                </select>
                                <p x-show="errors.status" x-text="errors.status?.[0]"
                                    class="mt-2 text-sm text-red-600 font-medium"></p>
                            </div>

                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-100 bg-gray-50/50 flex items-center justify-end space-x-4">
                        <a href="{{ route('admin.orders.show', $booking->id) }}"
                            class="text-gray-600 hover:text-orange-600 text-sm font-bold transition-colors">Cancel</a>
                        <button type="submit" :disabled="loading || isOverpaying"
                            class="text-white bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:ring-orange-200 font-bold rounded-lg text-sm px-6 py-3 transition-all disabled:opacity-50 inline-flex items-center">
                            <svg x-show="loading" class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" fill="none"
                                viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <span x-text="loading ? 'Processing...' : 'Save Payment'"></span>
                        </button>
                    </div>
                </form>
            </div>

            <div class="xl:col-span-1">
                <div class="p-6 bg-slate-900 text-white rounded-xl shadow-sm space-y-6 sticky top-6">
                    <h3 class="text-lg font-bold text-orange-500">Balance Breakdown</h3>

                    <div class="space-y-4">
                        <div class="flex justify-between border-b border-slate-700 pb-2">
                            <span class="text-slate-400 text-sm">Booking Total</span>
                            <span class="font-bold text-lg">₱{{ number_format($booking->total_price, 2) }}</span>
                        </div>
                        <div class="flex justify-between border-b border-slate-700 pb-2">
                            <span class="text-slate-400 text-sm">Previously Paid</span>
                            <span class="font-bold text-green-400">₱{{ number_format($totalPaid, 2) }}</span>
                        </div>
                        <div class="flex justify-between items-center pt-2">
                            <span class="text-slate-300 font-bold">New Balance</span>
                            <span class="text-2xl font-black transition-colors"
                                :class="isOverpaying ? 'text-red-500' : 'text-orange-500'">
                                ₱<span x-text="calculateRemaining()"></span>
                            </span>
                        </div>
                    </div>

                    <div
                        class="bg-slate-800 p-4 rounded-lg text-xs text-slate-400 leading-relaxed italic border-l-4 border-orange-500">
                        Recording a payment updates the financial records. The system will prevent saving if the amount
                        exceeds the remaining balance.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function paymentForm(config) {
            return {
                formData: {
                    booking_id: config.booking_id,
                    payment_method: '',
                    amount: 0,
                    status: 'partially_paid',
                },
                remainingBefore: config.remaining,
                errors: {},
                loading: false,
                showSuccess: false,

                // Computed check for overpayment
                get isOverpaying() {
                    return (this.formData.amount || 0) > this.remainingBefore;
                },

                calculateRemaining() {
                    const diff = this.remainingBefore - (this.formData.amount || 0);
                    // If negative, show 0, otherwise show the difference
                    const displayValue = diff < 0 ? 0 : diff;
                    return displayValue.toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                },

                async submitForm() {
                    if (this.isOverpaying) return;

                    this.loading = true;
                    this.errors = {};
                    this.showSuccess = false;

                    try {
                        await axios.post("{{ route('admin.payments.store') }}", this.formData);
                        this.showSuccess = true;
                        setTimeout(() => {
                            window.location.href = "{{ route('admin.orders.show', $booking->id) }}";
                        }, 1500);
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
