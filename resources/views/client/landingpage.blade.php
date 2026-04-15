<x-layout.app-layout title="Modern Catering | Premium Events">
    <style>
        .text-outline {
            -webkit-text-stroke: 1px #f97316;
            color: transparent;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>

    <div class="min-h-screen bg-white" x-data="{
        scrollToPackages() {
            document.getElementById('packages').scrollIntoView({ behavior: 'smooth' });
        }
    }">

        <header class="relative h-[90vh] flex items-center bg-slate-900 overflow-hidden">
            <div class="absolute inset-0 opacity-50">
                <img src="https://images.unsplash.com/photo-1555244162-803834f70033?auto=format&fit=crop&q=80&w=2000"
                    alt="Catering Backdrop" class="w-full h-full object-cover" />
            </div>

            <div class="container relative z-10 mx-auto px-6">
                <div class="max-w-3xl">
                    <span
                        class="inline-block mb-6 bg-orange-500 text-white px-4 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                        Professional Catering Services
                    </span>
                    <h1 class="text-6xl md:text-8xl font-black text-white mb-8 tracking-tighter">
                        <span>EVENTS</span>
                        <span class="text-orange-500 text-outline">REDEFINED.</span>
                    </h1>
                    <p class="text-xl text-slate-300 mb-10 max-w-xl leading-relaxed">
                        From high-stakes corporate galas to intimate garden weddings. We bring the kitchen, the talent,
                        and the magic.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <button @click="scrollToPackages"
                            class="bg-orange-600 hover:bg-orange-700 text-white font-bold h-14 px-8 rounded-lg text-lg transition-all shadow-lg hover:shadow-orange-500/20">
                            View Packages
                        </button>
                        <a href="#"
                            class="flex items-center justify-center text-white border border-white/20 hover:bg-white/10 h-14 px-8 rounded-lg text-lg backdrop-blur-sm transition-all font-bold">
                            Our Process
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <section class="py-20 md:py-32 container mx-auto px-6 grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            <div class="grid grid-cols-2 gap-4">
                <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?auto=format&fit=crop&q=80&w=800"
                    class="rounded-2xl mt-12 shadow-xl" alt="Chef" />
                <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?auto=format&fit=crop&q=80&w=800"
                    class="rounded-2xl shadow-xl" alt="Fine dining" />
            </div>
            <div class="space-y-8">
                <h2 class="text-4xl md:text-5xl font-bold text-slate-900 tracking-tight">Why Choose Our Catering?</h2>
                <p class="text-lg text-slate-600 leading-relaxed">
                    We believe every event tells a story. Since 2012, we've helped over 500 clients tell theirs through
                    bespoke menus and flawless execution.
                </p>
                <div class="space-y-4">
                    @foreach (['Farm-to-Table Sourcing', 'Custom Mixology Bars', 'Certified Executive Chefs'] as $feat)
                        <div class="flex items-center gap-3">
                            <div
                                class="h-6 w-6 rounded-full bg-orange-100 flex items-center justify-center text-orange-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M20 6L9 17l-5-5" />
                                </svg>
                            </div>
                            <span class="font-semibold text-slate-800">{{ $feat }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="bg-orange-600 py-16">
            <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-12 text-white text-center">
                @foreach ([['v' => '250+', 'l' => 'Weddings'], ['v' => '50+', 'l' => 'Corporate Partners'], ['v' => '15', 'l' => 'Award Titles']] as $stat)
                    <div>
                        <p class="text-5xl md:text-6xl font-black mb-2">{{ $stat['v'] }}</p>
                        <p class="text-orange-200 uppercase tracking-widest text-sm font-bold">{{ $stat['l'] }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        <section id="packages" class="py-20 md:py-32 bg-slate-50">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16 md:mb-20">
                    <h2 class="text-5xl font-extrabold text-slate-900 mb-6">Service Packages</h2>
                    <div class="h-1.5 w-20 bg-orange-600 mx-auto rounded-full"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach ($packages as $pkg)
                        <div
                            class="bg-white rounded-2xl overflow-hidden group hover:ring-2 hover:ring-orange-500 transition-all duration-300 shadow-sm hover:shadow-2xl">
                            <div class="h-64 relative overflow-hidden">
                                <img src="{{ $pkg->image_path ? asset('storage/' . $pkg->image_path) : 'https://via.placeholder.com/800x600?text=Premium+Catering' }}"
                                    alt="{{ $pkg->name }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent">
                                </div>
                                <div class="absolute bottom-4 left-5 text-white">
                                    <p class="text-2xl font-black">
                                        ₱{{ number_format($pkg->price, 2) }}
                                        <span class="text-sm font-normal text-slate-300 uppercase">/ guest</span>
                                    </p>
                                </div>
                            </div>

                            <div class="p-8">
                                <h3 class="text-2xl font-bold text-slate-900 mb-3">{{ $pkg->name }}</h3>
                                <p class="text-slate-500 text-md leading-relaxed whitespace-pre-line mb-8">
                                    {{ $pkg->description }}
                                </p>

                                <a href="{{ route('client.booking', $pkg->id) }}" class="block">
                                    <button
                                        class="w-full bg-slate-900 hover:bg-orange-600 text-white font-bold py-4 rounded-xl transition-all transform active:scale-[0.98]">
                                        Book This Package
                                    </button>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</x-layout.app-layout>
