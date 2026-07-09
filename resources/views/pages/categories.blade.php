<x-layouts.app title="Categories | Kasiinfo Photo Challenge 2026">
    <header class="pt-32 pb-20 bg-dark text-white text-center border-b border-gray-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-heading text-5xl md:text-7xl mb-4" data-aos="fade-up">Competition Categories</h1>
            <p class="text-xl text-gray-300" data-aos="fade-up" data-aos-delay="100">Choose the category that matches your gear.</p>
        </div>
    </header>

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Smartphone Category -->
            <div id="smartphone" class="mb-32 scroll-mt-32">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div class="order-2 lg:order-1" data-aos="fade-right">
                        <span class="text-gold font-bold tracking-wider text-sm uppercase mb-3 block">Category 01</span>
                        <h2 class="font-heading text-5xl mb-6 text-dark">Smartphone</h2>
                        <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                            The best camera is the one you have with you. This category is dedicated to the agility and accessibility of mobile photography. Show us that vision matters more than expensive gear.
                        </p>
                        
                        <div class="space-y-6">
                            <div>
                                <h4 class="font-bold text-dark flex items-center mb-2"><i data-lucide="check" class="text-green-500 w-5 h-5 mr-2"></i> Allowed Equipment</h4>
                                <ul class="text-gray-600 text-sm space-y-1 pl-7">
                                    <li>Any brand or model of smartphone.</li>
                                    <li>Built-in camera lenses (Ultrawide, Wide, Telephoto).</li>
                                    <li>Clip-on mobile lenses.</li>
                                    <li>Mobile gimbals or tripods.</li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-bold text-dark flex items-center mb-2"><i data-lucide="x" class="text-red-500 w-5 h-5 mr-2"></i> Prohibited Equipment</h4>
                                <ul class="text-gray-600 text-sm space-y-1 pl-7">
                                    <li>Tablets or iPads.</li>
                                    <li>Action cameras (GoPro, DJI Osmo Action, etc).</li>
                                    <li>Drones.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="order-1 lg:order-2 rounded-3xl overflow-hidden shadow-2xl relative aspect-[4/3]" data-aos="fade-left">
                        <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?q=80&w=1780&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover" alt="Smartphone Photography">
                        <div class="absolute inset-0 bg-gradient-to-t from-dark/60 to-transparent"></div>
                    </div>
                </div>
            </div>

            <hr class="border-gray-200 mb-32">

            <!-- DSLR / Mirrorless Category -->
            <div id="dslr" class="scroll-mt-32">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div class="rounded-3xl overflow-hidden shadow-2xl relative aspect-[4/3]" data-aos="fade-right">
                        <img src="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?q=80&w=1964&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover" alt="DSLR Photography">
                        <div class="absolute inset-0 bg-gradient-to-t from-dark/60 to-transparent"></div>
                    </div>
                    <div data-aos="fade-left">
                        <span class="text-gold font-bold tracking-wider text-sm uppercase mb-3 block">Category 02</span>
                        <h2 class="font-heading text-5xl mb-6 text-dark">DSLR / Mirrorless</h2>
                        <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                            For the enthusiasts and the professionals. This category allows full control over your exposure, depth of field, and focal length. Craft your masterpiece with precision.
                        </p>
                        
                        <div class="space-y-6">
                            <div>
                                <h4 class="font-bold text-dark flex items-center mb-2"><i data-lucide="check" class="text-green-500 w-5 h-5 mr-2"></i> Allowed Equipment</h4>
                                <ul class="text-gray-600 text-sm space-y-1 pl-7">
                                    <li>Any DSLR or Mirrorless camera.</li>
                                    <li>Point-and-shoot digital cameras.</li>
                                    <li>Analog/Film cameras (scanned digitally without manipulation).</li>
                                    <li>Any interchangeable lens.</li>
                                    <li>Tripods, flashes, reflectors, and filters.</li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-bold text-dark flex items-center mb-2"><i data-lucide="x" class="text-red-500 w-5 h-5 mr-2"></i> Prohibited Equipment</h4>
                                <ul class="text-gray-600 text-sm space-y-1 pl-7">
                                    <li>Drones.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</x-layouts.app>
