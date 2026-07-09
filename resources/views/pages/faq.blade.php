<x-layouts.app title="FAQ | Kasiinfo Photo Challenge 2026">
    <header class="pt-32 pb-20 bg-dark text-white text-center border-b border-gray-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-heading text-5xl md:text-7xl mb-4" data-aos="fade-up">FAQ</h1>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">Pertanyaan yang Sering Diajukan seputar Kasiinfo Photo Challenge 2026.</p>
        </div>
    </header>

    <section class="py-24 bg-gray-50 min-h-[600px]">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="space-y-4" x-data="{ selected: null }">
                
                <!-- FAQ 1 -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden" data-aos="fade-up">
                    <button @click="selected !== 1 ? selected = 1 : selected = null" class="flex justify-between items-center w-full p-6 text-left focus:outline-none">
                        <span class="font-bold text-dark text-lg">Apakah kompetisi ini dipungut biaya pendaftaran?</span>
                        <i data-lucide="chevron-down" class="w-5 h-5 text-gray-400 transform transition-transform" :class="{'rotate-180': selected === 1}"></i>
                    </button>
                    <div x-show="selected === 1" x-collapse>
                        <div class="p-6 pt-0 text-gray-600">
                            Tidak. Pendaftaran Kasiinfo Photo Challenge 2026 100% GRATIS dan tidak dipungut biaya apapun dari peserta.
                        </div>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                    <button @click="selected !== 2 ? selected = 2 : selected = null" class="flex justify-between items-center w-full p-6 text-left focus:outline-none">
                        <span class="font-bold text-dark text-lg">Bolehkah saya ikut dua kategori sekaligus (Smartphone dan DSLR)?</span>
                        <i data-lucide="chevron-down" class="w-5 h-5 text-gray-400 transform transition-transform" :class="{'rotate-180': selected === 2}"></i>
                    </button>
                    <div x-show="selected === 2" x-collapse>
                        <div class="p-6 pt-0 text-gray-600">
                            Tidak diperbolehkan. Sesuai Juknis, setiap peserta hanya boleh mengikuti SATU kategori dan mengirimkan 1 (satu) karya foto terbaik.
                        </div>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                    <button @click="selected !== 3 ? selected = 3 : selected = null" class="flex justify-between items-center w-full p-6 text-left focus:outline-none">
                        <span class="font-bold text-dark text-lg">Apakah foto boleh diedit menggunakan Photoshop/Lightroom?</span>
                        <i data-lucide="chevron-down" class="w-5 h-5 text-gray-400 transform transition-transform" :class="{'rotate-180': selected === 3}"></i>
                    </button>
                    <div x-show="selected === 3" x-collapse>
                        <div class="p-6 pt-0 text-gray-600">
                            Boleh, tetapi hanya terbatas pada editing dasar seperti crop proporsional, exposure, white balance, color correction, sharpening, dan noise reduction. Segala bentuk manipulasi yang mengubah elemen asli foto (menambah/menghapus objek, AI generatif, mengganti langit) akan langsung didiskualifikasi.
                        </div>
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden" data-aos="fade-up" data-aos-delay="300">
                    <button @click="selected !== 4 ? selected = 4 : selected = null" class="flex justify-between items-center w-full p-6 text-left focus:outline-none">
                        <span class="font-bold text-dark text-lg">Apakah saya boleh memakai foto lama?</span>
                        <i data-lucide="chevron-down" class="w-5 h-5 text-gray-400 transform transition-transform" :class="{'rotate-180': selected === 4}"></i>
                    </button>
                    <div x-show="selected === 4" x-collapse>
                        <div class="p-6 pt-0 text-gray-600">
                            Boleh, asalkan foto tersebut diambil antara 1 Januari 2026 hingga penutupan lomba. Jika foto diambil sebelum 1 Januari 2026, maka karya tersebut tidak sah. Foto lama yang pernah menang dalam lomba lain (sebagai juara utama/favorit) juga tidak diperbolehkan ikut serta.
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 text-center" data-aos="fade-up">
                <p class="text-gray-500 mb-4">Masih punya pertanyaan yang belum terjawab?</p>
                <a href="{{ url('/contact') }}" class="text-gold font-bold hover:text-yellow-600 transition-colors">
                    Hubungi Tim Kasiinfo &rarr;
                </a>
            </div>

        </div>
    </section>
</x-layouts.app>
