@php
    $navLinks = [
        'Package Management' => route('admin.packages'),
        'Create Package' => '#',
    ];
@endphp

<x-layout.admin-app-layout title="Create Package" :breadcrumbs="$navLinks">

    <div class="p-6" x-data="packageForm()">

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
            <div class="ms-3 text-sm font-bold">
                Package created successfully!
            </div>
            <button type="button" @click="showSuccess = false"
                class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>

        <div class="flex items-center justify-between mb-8">
            <div class="space-y-1">
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Create New Package</h1>
                <p class="text-base font-normal text-gray-500">Configure the pricing and features for your new
                    subscription tier.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            <div class="xl:col-span-2">
                <form @submit.prevent="submitForm" class="bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-6">
                                <label for="name" class="block mb-2 text-sm font-bold text-gray-700">Package
                                    Name</label>
                                <input type="text" x-model="formData.name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 block w-full p-3 transition-all outline-none"
                                    :class="errors.name ? 'border-red-500 bg-red-50' : 'border-gray-300'"
                                    placeholder="e.g. Enterprise Elite" required>
                                <p x-show="errors.name" x-text="errors.name ? errors.name[0] : ''"
                                    class="mt-2 text-sm text-red-600 font-medium"></p>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="price" class="block mb-2 text-sm font-bold text-gray-700">Price (Per
                                    Person)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                        <span class="text-gray-500 font-semibold">₱</span>
                                    </div>
                                    <input type="number" step="0.01" x-model="formData.price" id="price"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 block w-full pl-9 p-3 transition-all outline-none"
                                        :class="errors.price ? 'border-red-500 bg-red-50' : 'border-gray-300'"
                                        placeholder="0.00" required>
                                </div>
                                <p x-show="errors.price" x-text="errors.price ? errors.price[0] : ''"
                                    class="mt-2 text-sm text-red-600 font-medium"></p>
                            </div>

                            <div class="col-span-6">
                                <label for="description"
                                    class="block mb-2 text-sm font-bold text-gray-700">Description</label>
                                <textarea id="description" x-model="formData.description" rows="8"
                                    class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 transition-all outline-none resize-none"
                                    :class="errors.description ? 'border-red-500 bg-red-50' : 'border-gray-300'"
                                    placeholder="Briefly describe what makes this package special..."></textarea>
                                <p x-show="errors.description" x-text="errors.description ? errors.description[0] : ''"
                                    class="mt-2 text-sm text-red-600 font-medium"></p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="p-6 border-t border-gray-100 bg-gray-50/50 rounded-b-xl flex items-center justify-end space-x-4">
                        <a href="{{ route('admin.packages') }}"
                            class="text-gray-600 hover:text-orange-600 text-sm font-bold transition-colors">Discard
                            Changes</a>
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
                            <span x-text="loading ? 'Creating...' : 'Create Package'"></span>
                        </button>
                    </div>
                </form>
            </div>

            <div class="xl:col-span-1">
                <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm space-y-4">
                    <h3 class="text-lg font-bold text-gray-800">Package Preview</h3>
                    <div
                        class="relative group aspect-video bg-gray-100 rounded-lg border-2 border-dashed border-gray-300 flex items-center justify-center overflow-hidden transition-all hover:border-orange-400">
                        <template x-if="imageUrl">
                            <img :src="imageUrl" class="object-cover w-full h-full">
                        </template>
                        <template x-if="!imageUrl">
                            <div class="text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <p class="mt-1 text-sm text-gray-500">No image selected</p>
                            </div>
                        </template>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="image_path">Upload
                            Cover</label>
                        <input type="file" @change="handleImageChange" id="image_path"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:bg-orange-500 file:text-white file:border-0 file:py-2.5 file:px-4 file:mr-4 file:font-bold file:hover:bg-orange-600 transition-all">
                    </div>
                    <p x-show="errors.image_path" x-text="errors.image_path ? errors.image_path[0] : ''"
                        class="mt-2 text-sm text-red-600 font-medium"></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function packageForm() {
            return {
                formData: {
                    name: '',
                    price: '',
                    description: ''
                },
                imageUrl: null,
                errors: {},
                loading: false,
                showSuccess: false,

                handleImageChange(e) {
                    const file = e.target.files[0];
                    if (file) {
                        this.imageUrl = URL.createObjectURL(file);
                    }
                },

                resetForm() {
                    this.formData = {
                        name: '',
                        price: '',
                        description: ''
                    };
                    this.imageUrl = null;
                    this.errors = {};
                    const fileInput = document.getElementById('image_path');
                    if (fileInput) fileInput.value = '';
                },

                async submitForm() {
                    this.loading = true;
                    this.errors = {};
                    this.showSuccess = false;

                    let data = new FormData();
                    data.append('name', this.formData.name);
                    data.append('price', this.formData.price);
                    data.append('description', this.formData.description);

                    const fileInput = document.getElementById('image_path');
                    if (fileInput.files[0]) {
                        data.append('image_path', fileInput.files[0]);
                    }

                    try {
                        await axios.post("{{ route('admin.packages.store') }}", data);
                        this.showSuccess = true;
                        this.resetForm();

                        // Scroll to top to see message
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });

                        setTimeout(() => {
                            this.showSuccess = false;
                        }, 5000);
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
