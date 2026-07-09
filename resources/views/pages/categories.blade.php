<x-layouts.app title="Kategori | Kasiinfo Photo Challenge 2026">
    <header class="pt-32 pb-20 bg-dark text-white text-center border-b border-gray-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-heading text-5xl md:text-7xl mb-4" data-aos="fade-up">Kategori Kompetisi</h1>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">Setiap peserta hanya diperbolehkan mengikuti SATU kategori. Pilih peralatan andalan Anda.</p>
        </div>
    </header>

    <section class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-24">
                
                <!-- Smartphone -->
                <div id="smartphone" class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div class="order-2 lg:order-1" data-aos="fade-right">
                        <span class="text-gold font-bold tracking-wider text-sm uppercase mb-3 block">Kategori Bebas</span>
                        <h2 class="font-heading text-4xl mb-6 text-dark">Smartphone</h2>
                        <p class="text-gray-600 text-lg leading-relaxed mb-6">
                            Fotografi saat ini dapat diakses oleh semua orang. Kami mengundang seluruh warga Paser untuk menangkap momen luar biasa hanya menggunakan kamera bawaan Android atau iPhone yang ada di saku Anda.
                        </p>
                        <ul class="space-y-4 mb-8">
                            <li class="flex items-start">
                                <i data-lucide="check-circle-2" class="w-6 h-6 text-green-500 mr-3 flex-shrink-0"></i>
                                <span class="text-gray-700">Wajib menggunakan kamera bawaan (Native App) Android atau iOS.</span>
                            </li>
                            <li class="flex items-start">
                                <i data-lucide="check-circle-2" class="w-6 h-6 text-green-500 mr-3 flex-shrink-0"></i>
                                <span class="text-gray-700">Toleransi noise/kualitas sensor disesuaikan, namun ketajaman objek tetap menjadi fokus penilaian.</span>
                            </li>
                            <li class="flex items-start">
                                <i data-lucide="check-circle-2" class="w-6 h-6 text-green-500 mr-3 flex-shrink-0"></i>
                                <span class="text-gray-700">Terbuka untuk pelajar, mahasiswa, dan masyarakat umum amatir.</span>
                            </li>
                        </ul>
                        <a href="{{ url('/register?cat=smartphone') }}" class="inline-flex items-center text-dark font-bold hover:text-gold transition-colors">
                            Daftar Kategori Ini <i data-lucide="arrow-right" class="ml-2 w-5 h-5"></i>
                        </a>
                    </div>
                    <div class="order-1 lg:order-2 relative" data-aos="fade-left">
                        <div class="aspect-[4/3] rounded-3xl overflow-hidden shadow-2xl">
                            <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?q=80&w=1780&auto=format&fit=crop" alt="Smartphone Photography" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>

                <!-- DSLR/Mirrorless -->
                <div id="dslr" class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div class="relative" data-aos="fade-right">
                        <div class="aspect-[4/3] rounded-3xl overflow-hidden shadow-2xl">
                            <img src="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?q=80&w=1964&auto=format&fit=crop" alt="DSLR Photography" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <div data-aos="fade-left">
                        <span class="text-gold font-bold tracking-wider text-sm uppercase mb-3 block">Kategori Profesional</span>
                        <h2 class="font-heading text-4xl mb-6 text-dark">Kamera DSLR / Mirrorless</h2>
                        <p class="text-gray-600 text-lg leading-relaxed mb-6">
                            Untuk para antusias fotografi dan profesional yang mengutamakan kualitas visual maksimal. Gunakan peralatan tempur Anda dengan kebebasan kreatif dan eksplorasi lensa tanpa batas.
                        </p>
                        <ul class="space-y-4 mb-8">
                            <li class="flex items-start">
                                <i data-lucide="check-circle-2" class="w-6 h-6 text-green-500 mr-3 flex-shrink-0"></i>
                                <span class="text-gray-700">Mencakup semua merk kamera DSLR, Mirrorless, maupun kamera digital format besar lainnya.</span>
                            </li>
                            <li class="flex items-start">
                                <i data-lucide="check-circle-2" class="w-6 h-6 text-green-500 mr-3 flex-shrink-0"></i>
                                <span class="text-gray-700">Penilaian teknis sangat ketat (ketajaman maksimal, eksposur sempurna, rentang dinamis).</span>
                            </li>
                            <li class="flex items-start">
                                <i data-lucide="check-circle-2" class="w-6 h-6 text-green-500 mr-3 flex-shrink-0"></i>
                                <span class="text-gray-700">Terbuka untuk pegiat fotografi tingkat lanjut, jurnalis, dan profesional.</span>
                            </li>
                        </ul>
                        <a href="{{ url('/register?cat=dslr') }}" class="inline-flex items-center text-dark font-bold hover:text-gold transition-colors">
                            Daftar Kategori Ini <i data-lucide="arrow-right" class="ml-2 w-5 h-5"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
</x-layouts.app>
