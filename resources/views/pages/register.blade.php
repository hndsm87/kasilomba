<x-layouts.app title="Register | Kasiinfo Photo Challenge 2026">
    <header class="pt-32 pb-20 bg-dark text-white text-center border-b border-gray-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-gold font-bold tracking-wider text-sm uppercase mb-3 block" data-aos="fade-up">Join The Challenge</span>
            <h1 class="font-heading text-5xl md:text-7xl mb-4" data-aos="fade-up" data-aos-delay="100">Submit Your Masterpiece</h1>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">Fill out the form below to officially enter the Kasiinfo Photo Challenge 2026. Make sure you have read the guidebook before proceeding.</p>
        </div>
    </header>

    <section class="py-16 bg-gray-50 relative min-h-[800px]">
        <div class="absolute top-0 left-0 w-full h-64 bg-dark"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- Warning Alert -->
            <div class="bg-yellow-50 border-l-4 border-gold p-4 rounded-r-lg mb-8 shadow-md" data-aos="fade-up">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i data-lucide="alert-triangle" class="h-5 w-5 text-yellow-600"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-800 font-medium">
                            Attention: Prepare your KTP/Kartu Pelajar and your final photo (Max 10MB) before starting to fill out this form.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Form Container (Iframe Placeholder) -->
            <div class="bg-white rounded-3xl shadow-2xl border border-gray-200 overflow-hidden min-h-[600px] flex flex-col" data-aos="fade-up" data-aos-delay="100">
                <!-- Browser-like header for aesthetic -->
                <div class="bg-gray-100 border-b border-gray-200 px-4 py-3 flex items-center">
                    <div class="flex space-x-2">
                        <div class="w-3 h-3 rounded-full bg-red-400"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                        <div class="w-3 h-3 rounded-full bg-green-400"></div>
                    </div>
                    <div class="mx-auto bg-white rounded-md px-4 py-1 text-xs text-gray-400 border border-gray-200 flex items-center">
                        <i data-lucide="lock" class="w-3 h-3 mr-1 text-green-500"></i> Secure Fillout Form
                    </div>
                </div>

                <!-- Fillout Form Embed -->
                <div class="flex-grow w-full bg-gray-50 relative">
                    <div style="width:100%;height:800px;" data-fillout-id="uXE5YL5tpdus" data-fillout-embed-type="standard" data-fillout-inherit-parameters data-fillout-dynamic-resize></div>
                    <script src="https://server.fillout.com/embed/v1/"></script>
                </div>
            </div>

            <!-- After Registration Instructions -->
            <div class="mt-16 text-center" data-aos="fade-up">
                <h3 class="font-heading text-3xl text-dark mb-4">What's Next?</h3>
                <p class="text-gray-600 mb-6">After submitting this form, do not forget to upload the exact same photo to your Instagram.</p>
                <a href="{{ url('/join') }}" class="text-gold font-bold hover:text-yellow-600 transition-colors">
                    Review "How To Join" Steps &rarr;
                </a>
            </div>

        </div>
    </section>
</x-layouts.app>
