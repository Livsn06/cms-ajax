@php
    $navLinks = [
        'Booking Management' => route('admin.orders'),
        'Booking Details' => '#',
    ];
@endphp

<x-layout.admin-app-layout title="Booking Details" :breadcrumbs="$navLinks">

    <div class="p-6" x-data="bookingDetails({
        id: {{ $booking->id }},
        status: '{{ $booking->status }}'
    })">

        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div class="space-y-1">
                <div class="flex items-center gap-3">
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Booking #{{ $booking->id }}</h1>
                    <span
                        :class="{
                            'bg-yellow-100 text-yellow-800': status === 'pending',
                            'bg-green-100 text-green-800': status === 'confirmed',
                            'bg-blue-100 text-blue-800': status === 'completed',
                            'bg-red-100 text-red-800': status === 'cancelled'
                        }"
                        class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider" x-text="status">
                    </span>
                </div>
                <p class="text-base font-normal text-gray-500">Placed on
                    {{ $booking->created_at->format('M d, Y h:i A') }}</p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.orders.print', $booking->id) }}" target="_blank"
                    class="px-5 py-2.5 text-sm font-bold text-white bg-slate-800 rounded-lg hover:bg-slate-700 transition-all flex items-center shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Print Summary
                </a>

                <a href="{{ route('admin.orders.edit', $booking->id) }}"
                    class="px-5 py-2.5 text-sm font-bold text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-all flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                </a>

                <template x-if="status === 'pending'">
                    <div class="flex gap-3">
                        <button @click="updateStatus('confirmed')"
                            class="px-5 py-2.5 text-sm font-bold text-white bg-green-600 hover:bg-green-700 rounded-lg transition-all shadow-sm">
                            Confirm Booking
                        </button>
                        <button @click="updateStatus('cancelled')"
                            class="px-5 py-2.5 text-sm font-bold text-white bg-orange-500 hover:bg-orange-600 rounded-lg transition-all shadow-sm">
                            Cancel
                        </button>
                    </div>
                </template>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            <div class="xl:col-span-2 space-y-8">
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="text-lg font-bold text-gray-800">Booking Information</h3>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase">Full Name</p>
                            <p class="text-base font-semibold text-gray-900">{{ $booking->fullname }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase">Phone Number</p>
                            <p class="text-base font-semibold text-gray-900">{{ $booking->phone }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase">Event Date</p>
                            <p class="text-base font-semibold text-gray-900">
                                {{ \Carbon\Carbon::parse($booking->event_date)->format('F d, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase">Guests</p>
                            <p class="text-base font-semibold text-gray-900">{{ $booking->guest_count }} People</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800">Package Summary</h3>
                    </div>
                    <div class="flex flex-col md:flex-row">
                        <div class="w-full md:w-1/3 bg-gray-50 flex items-center justify-center p-4">
                            @if ($booking->package->image_path)
                                <img src="{{ asset('storage/' . $booking->package->image_path) }}"
                                    class="rounded-lg object-cover h-32 w-full">
                            @else
                                <div
                                    class="h-32 w-full bg-gray-200 rounded-lg flex items-center justify-center text-gray-400">
                                    No Image</div>
                            @endif
                        </div>
                        <div class="p-6 flex-1 space-y-3">
                            <h4 class="text-xl font-bold text-orange-600">{{ $booking->package->name }}</h4>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ $booking->package->description }}</p>
                            <div class="pt-2">
                                <span
                                    class="bg-orange-50 text-orange-700 text-xs font-bold px-3 py-1 rounded-lg border border-orange-100">
                                    ₱ {{ number_format($booking->package->price, 2) }} / Head
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="xl:col-span-1 space-y-6">
                <div class="bg-slate-900 rounded-xl shadow-lg p-6 sticky top-6">
                    <h3 class="text-lg font-bold text-white mb-6">Payment Summary</h3>

                    <div class="space-y-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-400">Rate per head</span>
                            <span class="text-white font-medium">₱
                                {{ number_format($booking->package->price, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-400">Total Guests</span>
                            <span class="text-white font-medium">x {{ $booking->guest_count }}</span>
                        </div>
                        <div class="border-t border-slate-700 pt-4 mt-4">
                            <div class="flex justify-between items-center">
                                <span class="text-slate-300 font-bold uppercase tracking-wider text-xs">Grand
                                    Total</span>
                                <span class="text-3xl font-black text-orange-500">₱
                                    {{ number_format($booking->total_price, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-700 space-y-4">
                        <div class="flex items-center justify-between">
                            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Transactions</h4>
                            @php
                                $totalPaid = $booking->payments->sum('amount');
                                $isFullyPaid = $totalPaid >= $booking->total_price;
                                $isPartiallyPaid = $totalPaid > 0 && $totalPaid < $booking->total_price;
                            @endphp
                            @if ($isFullyPaid)
                                <span class="text-xs font-bold text-green-400">Fully Paid</span>
                            @elseif ($isPartiallyPaid)
                                <span class="text-xs font-bold text-orange-400">Partially Paid</span>
                            @else
                                <span class="text-xs font-bold text-red-400">Unpaid</span>
                            @endif
                        </div>

                        <div class="space-y-3">
                            @forelse ($booking->payments as $payment)
                                <div
                                    class="bg-slate-800/50 p-3 rounded-lg flex items-center justify-between border border-slate-700/50 group">
                                    <div>
                                        <p class="text-white text-sm font-bold">
                                            ₱{{ number_format($payment->amount, 2) }}</p>
                                        <p class="text-slate-500 text-[10px] uppercase">{{ $payment->payment_method }}
                                            • {{ $payment->created_at->format('M d') }}</p>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <button @click="deletePayment({{ $payment->id }})"
                                            class="p-1.5 text-slate-500 hover:text-red-500 transition-colors opacity-0 group-hover:opacity-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>

                                        <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4 border-2 border-dashed border-slate-800 rounded-lg">
                                    <p class="text-slate-500 text-xs italic">No payments recorded</p>
                                </div>
                            @endforelse
                        </div>

                        <a href="{{ route('admin.payments.create', $booking->id) }}" class="block w-full">
                            <button
                                class="w-full py-2 bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold rounded-lg transition-colors border border-slate-700">
                                + Record Payment
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function bookingDetails(config) {
            return {
                id: config.id,
                status: config.status,

                async updateStatus(newStatus) {
                    if (!confirm(`Move this booking to ${newStatus}?`)) return;
                    try {
                        await axios.patch("{{ route('admin.orders.status.update', $booking->id) }}", {
                            status: newStatus
                        });
                        this.status = newStatus;
                    } catch (error) {
                        alert('Failed to update status.');
                    }
                },

                async deleteBooking() {
                    if (!confirm('Are you absolutely sure? This cannot be undone.')) return;
                    try {
                        await axios.delete("{{ route('admin.orders.destroy', $booking->id) }}");
                        window.location.href = "{{ route('admin.orders') }}";
                    } catch (error) {
                        alert('Error deleting the booking.');
                    }
                },

                // NEW DELETE PAYMENT FUNCTION
                async deletePayment(paymentId) {
                    if (!confirm('Remove this payment record? This will affect the total balance.')) return;
                    try {
                        await axios.delete("{{ route('admin.payments.destroy', ':id') }}".replace(':id', paymentId));
                        location.reload(); // Reload to refresh the payment list and status
                    } catch (error) {
                        alert('Error deleting payment.');
                    }
                }
            }
        }
    </script>
</x-layout.admin-app-layout>
