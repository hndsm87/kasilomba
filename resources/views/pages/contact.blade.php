<x-layouts.app title="Kontak | Kasiinfo Photo Challenge 2026">
    <header class="pt-32 pb-20 bg-dark text-white text-center border-b border-gray-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-heading text-5xl md:text-7xl mb-4" data-aos="fade-up">Hubungi Kami</h1>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">Tim Kasiinfo siap membantu menjawab kendala teknis maupun pertanyaan seputar lomba.</p>
        </div>
    </header>

    <section class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                
                <!-- Contact Info -->
                <div data-aos="fade-right">
                    <span class="text-gold font-bold tracking-wider text-sm uppercase mb-3 block">Info Penyelenggara</span>
                    <h2 class="font-heading text-4xl mb-8 text-dark">Kasiinfo ID</h2>
                    <p class="text-gray-600 leading-relaxed mb-10 text-lg">
                        Media informasi terdepan Kabupaten Paser. Jangan ragu untuk menghubungi kami melalui media komunikasi di bawah ini pada jam kerja operasional.
                    </p>

                    <div class="space-y-8">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gold/10 rounded-full flex items-center justify-center mr-6 flex-shrink-0">
                                <i data-lucide="map-pin" class="w-5 h-5 text-gold"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-dark text-lg mb-1">Sekretariat</h4>
                                <p class="text-gray-600">Tanah Grogot, Kabupaten Paser<br>Kalimantan Timur, Indonesia</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gold/10 rounded-full flex items-center justify-center mr-6 flex-shrink-0">
                                <i data-lucide="mail" class="w-5 h-5 text-gold"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-dark text-lg mb-1">Email Resmi</h4>
                                <a href="mailto:halo@kasiinfo.id" class="text-gray-600 hover:text-gold transition-colors">halo@kasiinfo.id</a>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gold/10 rounded-full flex items-center justify-center mr-6 flex-shrink-0">
                                <i data-lucide="phone" class="w-5 h-5 text-gold"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-dark text-lg mb-1">WhatsApp / Telepon</h4>
                                <p class="text-gray-600">+62 812 3456 7890 (Hanya Jam Kerja)</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12">
                        <h4 class="font-bold text-dark mb-4">Ikuti Media Sosial Kami:</h4>
                        <div class="flex space-x-4">
                            <a href="#" class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center text-gray-500 hover:bg-gold hover:text-white transition-colors">
                                <i data-lucide="instagram" class="w-5 h-5"></i>
                            </a>
                            <a href="#" class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center text-gray-500 hover:bg-gold hover:text-white transition-colors">
                                <i data-lucide="twitter" class="w-5 h-5"></i>
                            </a>
                            <a href="#" class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center text-gray-500 hover:bg-gold hover:text-white transition-colors">
                                <i data-lucide="facebook" class="w-5 h-5"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Decorative Side -->
                <div class="relative hidden lg:block" data-aos="fade-left">
                    <div class="absolute inset-0 bg-dark rounded-3xl overflow-hidden shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1516383274235-5f42d6c6426d?q=80&w=2069&auto=format&fit=crop" class="w-full h-full object-cover opacity-60 mix-blend-overlay" alt="Contact Us">
                        <div class="absolute inset-0 flex items-center justify-center p-12 text-center">
                            <div>
                                <img src="{{ asset('images/logo.png') }}" alt="Kasiinfo Logo" class="h-16 mx-auto mb-6">
                                <p class="text-white text-lg font-light italic">"Dari tangan-tangan sederhana lahir kemajuan Bumi Paser."</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</x-layouts.app>
