<x-layouts.app title="Cara Bergabung | Kasiinfo Photo Challenge 2026">
    <header class="pt-32 pb-20 bg-dark text-white text-center border-b border-gray-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-heading text-5xl md:text-7xl mb-4" data-aos="fade-up">Cara Bergabung</h1>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">Ikuti dua langkah mudah ini untuk memastikan karya Anda terdaftar secara resmi dan sah untuk dinilai.</p>
        </div>
    </header>

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Step 1: Website -->
                <div class="bg-gray-50 rounded-3xl p-10 border border-gray-100 shadow-xl relative overflow-hidden" data-aos="fade-up">
                    <div class="absolute top-0 right-0 bg-gold text-dark font-bold py-2 px-6 rounded-bl-3xl">LANGKAH 1</div>
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-md mb-8">
                        <i data-lucide="globe" class="w-8 h-8 text-dark"></i>
                    </div>
                    <h2 class="font-heading text-3xl mb-4 text-dark">Registrasi Melalui Website</h2>
                    <p class="text-gray-600 mb-6">Sebagai pintu masuk utama, Anda diwajibkan untuk mengisi formulir pendaftaran secara lengkap dan valid.</p>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <i data-lucide="check" class="w-5 h-5 text-gold mr-3 mt-0.5 flex-shrink-0"></i>
                            <span class="text-gray-700">Akses halaman <a href="{{ url('/register') }}" class="font-bold hover:text-gold transition-colors">Register</a>.</span>
                        </li>
                        <li class="flex items-start">
                            <i data-lucide="check" class="w-5 h-5 text-gold mr-3 mt-0.5 flex-shrink-0"></i>
                            <span class="text-gray-700">Mengisi biodata dengan melampirkan identitas resmi (KTP/SIM/Kartu Pelajar).</span>
                        </li>
                        <li class="flex items-start">
                            <i data-lucide="check" class="w-5 h-5 text-gold mr-3 mt-0.5 flex-shrink-0"></i>
                            <span class="text-gray-700">Mengunggah file foto (maks. 10MB) tanpa watermark.</span>
                        </li>
                        <li class="flex items-start">
                            <i data-lucide="check" class="w-5 h-5 text-gold mr-3 mt-0.5 flex-shrink-0"></i>
                            <span class="text-gray-700">Menyertakan judul, lokasi, dan narasi/cerita foto maksimal 150 kata.</span>
                        </li>
                        <li class="flex items-start">
                            <i data-lucide="check" class="w-5 h-5 text-gold mr-3 mt-0.5 flex-shrink-0"></i>
                            <span class="text-gray-700">Menyetujui seluruh syarat, ketentuan, serta pernyataan orisinalitas karya.</span>
                        </li>
                    </ul>
                    <a href="{{ url('/register') }}" class="block w-full text-center bg-dark text-white py-3 rounded-xl font-bold hover:bg-gray-800 transition-colors">
                        Mulai Registrasi
                    </a>
                </div>

                <!-- Step 2: Instagram -->
                <div class="bg-gray-50 rounded-3xl p-10 border border-gray-100 shadow-xl relative overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                    <div class="absolute top-0 right-0 bg-dark text-gold font-bold py-2 px-6 rounded-bl-3xl">LANGKAH 2</div>
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-md mb-8">
                        <i data-lucide="instagram" class="w-8 h-8 text-pink-600"></i>
                    </div>
                    <h2 class="font-heading text-3xl mb-4 text-dark">Publikasi Instagram</h2>
                    <p class="text-gray-600 mb-6">Agar karya Anda dapat dilihat oleh publik dan masuk bursa juara favorit, unggah foto tersebut di Instagram.</p>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i data-lucide="check" class="w-5 h-5 text-pink-600 mr-3 mt-0.5 flex-shrink-0"></i>
                            <span class="text-gray-700">Unggah file foto yang sama persis dengan yang dikirim melalui website.</span>
                        </li>
                        <li class="flex items-start">
                            <i data-lucide="check" class="w-5 h-5 text-pink-600 mr-3 mt-0.5 flex-shrink-0"></i>
                            <span class="text-gray-700">Pastikan akun Instagram tidak terkunci (Public Account) hingga masa pengumuman.</span>
                        </li>
                        <li class="flex items-start">
                            <i data-lucide="check" class="w-5 h-5 text-pink-600 mr-3 mt-0.5 flex-shrink-0"></i>
                            <span class="text-gray-700">Wajib memberikan <strong>Tag</strong> dan <strong>Mention</strong> ke akun resmi <a href="#" class="text-blue-500 font-bold hover:underline">@kasiinfo.id</a>.</span>
                        </li>
                        <li class="flex items-start">
                            <i data-lucide="check" class="w-5 h-5 text-pink-600 mr-3 mt-0.5 flex-shrink-0"></i>
                            <span class="text-gray-700">Sertakan narasi Anda di caption dengan hashtag: <br>
                                <span class="text-blue-500 text-sm font-bold block mt-1">#KasiinfoPhotoChallenge2026 #RodaJuangBumiPaser #KasiinfoID</span>
                            </span>
                        </li>
                        <li class="flex items-start">
                            <i data-lucide="alert-circle" class="w-5 h-5 text-red-500 mr-3 mt-0.5 flex-shrink-0"></i>
                            <span class="text-gray-700 text-sm italic">Postingan dilarang dihapus sebelum pengumuman pemenang pada 17 Agustus 2026.</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Validation Note -->
            <div class="mt-16 bg-blue-50 border border-blue-100 p-6 rounded-2xl flex items-start shadow-sm" data-aos="fade-up">
                <i data-lucide="info" class="w-6 h-6 text-blue-500 mr-4 mt-0.5 flex-shrink-0"></i>
                <p class="text-blue-800 text-sm leading-relaxed">
                    <strong>Penting:</strong> Karya baru dianggap valid apabila peserta telah melakukan <strong>kedua langkah di atas</strong> (mengisi formulir di website Kasiinfo.id DAN mempostingnya di Instagram dengan format yang benar). Panitia berhak mendiskualifikasi karya apabila salah satu syarat tidak dipenuhi.
                </p>
            </div>
            
        </div>
    </section>
</x-layouts.app>
