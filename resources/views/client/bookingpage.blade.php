<x-layout.app-layout title="Book Your Event">
    <style>
        .text-outline {
            -webkit-text-stroke: 1.5px #f97316;
            color: transparent;
        }

        input[type='range']::-webkit-slider-thumb {
            appearance: none;
            height: 24px;
            width: 24px;
            border-radius: 50%;
            background: #f97316;
            cursor: pointer;
            border: 4px solid white;
            box-shadow: 0 4px 10px rgba(249, 115, 22, 0.3);
        }

        [x-cloak] {
            display: none !important;
        }
    </style>

    <div class="min-h-screen bg-slate-50 pb-20" x-data="bookingHandler()">
        <div class="bg-white border-b mb-12">
            <div class="container mx-auto px-6 py-8">
                <nav class="flex items-center gap-2 text-sm text-slate-500 mb-4">
                    <a href="/" class="hover:text-orange-600 transition-colors">Landing</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <path d="m9 18 6-6-6-6" />
                    </svg>
                    <span class="text-slate-900 font-medium">Booking</span>
                </nav>
                <h1 class="text-4xl font-black tracking-tight text-slate-900 uppercase leading-none">
                    SECURE YOUR <span class="text-outline">DATE</span>
                </h1>
            </div>
        </div>

        <div class="container mx-auto px-6 grid lg:grid-cols-12 gap-12">
            <div class="lg:col-span-7 space-y-6">
                <div class="bg-white rounded-xl border-none shadow-md overflow-hidden">
                    <div class="flex flex-col sm:flex-row">
                        <div class="sm:w-48 h-32 sm:h-auto overflow-hidden">
                            <img src="{{ $package->image_path ? asset('storage/' . $package->image_path) : 'https://via.placeholder.com/400x300' }}"
                                alt="{{ $package->name }}" class="w-full h-full object-cover" />
                        </div>
                        <div class="p-6 flex-1">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-xs font-bold text-orange-600 uppercase tracking-widest mb-1">Selected
                                        Package</p>
                                    <h2 class="text-2xl font-bold text-slate-900">{{ $package->name }}</h2>
                                </div>
                                <div class="text-right">
                                    <p class="text-2xl font-black text-slate-900">
                                        ₱{{ number_format($package->price, 2) }}</p>
                                    <p class="text-xs text-slate-500">per head</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/60 overflow-hidden">
                    <div class="p-8 border-b">
                        <h3 class="flex items-center gap-2 font-bold text-xl text-slate-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-orange-600 w-5 h-5" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M7 21 15 7" />
                                <path d="m9 17 8 4 3-3-4-8Z" />
                            </svg>
                            Reservation Details
                        </h3>
                    </div>

                    <div class="p-8">
                        <div x-show="sent" x-transition x-cloak
                            class="bg-green-50 border border-green-200 text-green-800 p-6 rounded-xl mb-6 text-center">
                            <h4 class="font-bold text-lg">Request Sent!</h4>
                            <p>We have received your reservation for <span class="font-bold"
                                    x-text="formData.event_date"></span>. We'll contact you soon.</p>
                        </div>

                        <form x-show="!sent" @submit.prevent="submitBooking" class="space-y-8">
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 font-semibold text-slate-700">Full Name</label>
                                <input type="text" x-model="formData.fullname" placeholder="e.g. John Doe"
                                    class="w-full rounded-lg border-slate-200 focus:border-orange-500"
                                    :class="errors.fullname ? 'border-red-500' : ''">
                                <p x-show="errors.fullname" x-text="errors.fullname" class="text-xs text-red-500"
                                    x-cloak></p>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="flex items-center gap-2 font-semibold text-slate-700">Event
                                        Date</label>
                                    <input type="date" x-model="formData.event_date"
                                        class="w-full rounded-lg border-slate-200 focus:border-orange-500"
                                        :class="errors.event_date ? 'border-red-500' : ''">
                                    <p x-show="errors.event_date" x-text="errors.event_date"
                                        class="text-xs text-red-500" x-cloak></p>
                                </div>

                                <div class="space-y-2">
                                    <label class="flex items-center gap-2 font-semibold text-slate-700">Phone
                                        Number</label>
                                    <input type="tel" x-model="formData.phone" placeholder="e.g. +63 XXXX XXX XXXX"
                                        class="w-full rounded-lg border-slate-200 focus:border-orange-500"
                                        :class="errors.phone ? 'border-red-500' : ''">
                                    <p x-show="errors.phone" x-text="errors.phone" class="text-xs text-red-500" x-cloak>
                                    </p>
                                </div>
                            </div>

                            <div class="space-y-6 pt-4">
                                <div class="flex justify-between items-end">
                                    <label class="font-semibold text-slate-700">Expected Guests</label>
                                    <span class="text-3xl font-black text-orange-600 leading-none"
                                        x-text="guestCount"></span>
                                </div>
                                <input type="range" min="10" max="500" x-model="guestCount"
                                    class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-orange-600" />
                            </div>

                            <button type="submit" :disabled="loading"
                                class="w-full bg-slate-900 text-white hover:bg-orange-600 h-16 text-lg font-bold rounded-xl transition-all shadow-lg flex items-center justify-center disabled:opacity-50">
                                <span x-show="!loading">Confirm Reservation Request</span>
                                <span x-show="loading" x-cloak>Processing...</span>
                            </button>
                        </form>

                        <div class="mt-8">
                            <h4 class="flex items-center gap-2 text-sm text-slate-500 italic">
                                <span class="text-slate-900 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Note</span>
                                <span class="text-orange-600">* Once you submit the request, wait for us
                                    to contact you to confirm your reservation.</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5 space-y-6">
                <div class="bg-slate-900 text-white p-8 rounded-3xl sticky top-8 shadow-2xl overflow-hidden">
                    <h3 class="text-xl font-bold mb-6 text-orange-500">Cost Estimate</h3>
                    <div class="space-y-4 relative z-10">
                        <div class="flex justify-between text-slate-400 text-sm">
                            <span>{{ $package->name }} (x<span x-text="guestCount"></span>)</span>
                            <span>₱<span x-text="formattedTotal()"></span></span>
                        </div>
                        <div class="border-t border-slate-700 pt-4 mt-4 flex justify-between items-end">
                            <span class="font-bold text-lg text-slate-300">Total Estimate</span>
                            <span class="text-3xl font-black text-white">₱<span
                                    x-text="formattedTotal()"></span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function bookingHandler() {
            return {
                guestCount: 20,
                pricePerGuest: {{ $package->price }},
                loading: false,
                sent: false,
                errors: {},
                formData: {
                    package_id: '{{ $package->id }}',
                    fullname: '{{ old('fullname', '') }}',
                    event_date: '{{ old('event_date', '') }}',
                    phone: '{{ old('phone', '') }}'
                },

                formattedTotal() {
                    let total = this.guestCount * this.pricePerGuest;
                    return total.toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                },

                async submitBooking() {
                    this.loading = true;
                    this.errors = {};

                    try {
                        const response = await fetch('{{ route('client.booking.store') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                ...this.formData,
                                guest_count: this.guestCount,
                                total_price: this.guestCount * this.pricePerGuest
                            })
                        });

                        const data = await response.json();

                        if (response.ok) {
                            this.sent = true;
                            // Optionally redirect: window.location.href = "/success";
                        } else if (response.status === 422) {
                            // Validation failed
                            this.errors = Object.keys(data.errors).reduce((acc, key) => {
                                acc[key] = data.errors[key][0]; // Take first error message
                                return acc;
                            }, {});
                        } else {
                            alert('Something went wrong. Please try again.');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Connection error.');
                    } finally {
                        this.loading = false;
                    }
                }
            }
        }
    </script>
</x-layout.app-layout>
