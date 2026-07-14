<x-layouts.app title="Panduan Lengkap | Kasiinfo Photo Challenge 2026">
    <header class="pt-32 pb-20 bg-dark text-white text-center border-b border-gray-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-heading text-5xl md:text-7xl mb-4" data-aos="fade-up">Buku Panduan</h1>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">Petunjuk Teknis resmi (Juknis) Kasiinfo Photo Challenge 2026. Harap baca dengan seksama sebelum mengirimkan karya Anda.</p>
        </div>
    </header>

    <section class="py-24 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden" x-data="{ activeTab: 'ketentuan' }">
                
                <!-- Tabs Header -->
                <div class="flex border-b border-gray-200 overflow-x-auto hide-scrollbar">
                    <button @click="activeTab = 'ketentuan'" :class="{ 'border-gold text-dark bg-gold/5': activeTab === 'ketentuan', 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50': activeTab !== 'ketentuan' }" class="flex-1 min-w-[150px] py-4 px-6 text-center border-b-2 font-bold text-sm transition-colors uppercase tracking-wider">
                        Ketentuan & Etika
                    </button>
                    <button @click="activeTab = 'editing'" :class="{ 'border-gold text-dark bg-gold/5': activeTab === 'editing', 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50': activeTab !== 'editing' }" class="flex-1 min-w-[150px] py-4 px-6 text-center border-b-2 font-bold text-sm transition-colors uppercase tracking-wider">
                        Aturan Editing
                    </button>
                    <button @click="activeTab = 'penilaian'" :class="{ 'border-gold text-dark bg-gold/5': activeTab === 'penilaian', 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50': activeTab !== 'penilaian' }" class="flex-1 min-w-[150px] py-4 px-6 text-center border-b-2 font-bold text-sm transition-colors uppercase tracking-wider">
                        Rubrik Penilaian
                    </button>
                </div>

                <!-- Tabs Content -->
                <div class="p-8 md:p-12">
                    
                    <!-- Tab: Ketentuan & Etika -->
                    <div x-show="activeTab === 'ketentuan'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-12">
                        
                        <div>
                            <h3 class="font-heading text-3xl mb-6 text-dark flex items-center">
                                <i data-lucide="shield-check" class="w-8 h-8 text-gold mr-3"></i> Ketentuan Karya
                            </h3>
                            <ul class="space-y-4 text-gray-600 leading-relaxed list-disc list-outside ml-6">
                                <li>1 peserta = 1 kategori = 1 karya foto.</li>
                                <li>Karya yang diikutsertakan haruslah murni hasil jepretan asli milik peserta.</li>
                                <li>Lokasi pengambilan foto wajib berada di dalam wilayah Kabupaten Paser.</li>
                                <li>Waktu pengambilan foto adalah antara periode 1 Januari 2026 sampai dengan penutupan lomba.</li>
                                <li>Foto boleh pernah dipublikasikan atau diikutsertakan pada lomba lain sebelumnya, <strong>kecuali</strong> jika karya tersebut pernah menjadi juara atau pemenang favorit.</li>
                                <li>Peserta wajib menyertakan Judul Foto, Lokasi Pengambilan, dan Cerita/Narasi maksimal 150 kata.</li>
                                <li>Lomba ini berfokus pada sosok yang melalui profesi, pekerjaan, atau pengabdiannya menjadi bagian dari roda penggerak kehidupan masyarakat Kabupaten Paser. Oleh karena itu, karya yang semata-mata menampilkan aktivitas kompetisi olahraga atau prestasi atlet sebagai subjek utama tidak menjadi ruang lingkup tema lomba.</li>
                            </ul>
                        </div>

                        <div>
                            <h3 class="font-heading text-3xl mb-6 text-dark flex items-center">
                                <i data-lucide="scale" class="w-8 h-8 text-gold mr-3"></i> Etika Fotografi
                            </h3>
                            <ul class="space-y-4 text-gray-600 leading-relaxed list-disc list-outside ml-6">
                                <li>Persetujuan (izin) dari subjek/model yang difoto sepenuhnya menjadi tanggung jawab fotografer.</li>
                                <li>Peserta wajib memastikan dan menyatakan telah memperoleh izin apabila subjek manusia di dalam foto dapat dikenali (identifiable).</li>
                                <li>Karya foto tidak boleh merendahkan martabat subjek, mengandung unsur SARA, pornografi, maupun mengeksploitasi penderitaan (poverty porn).</li>
                            </ul>
                        </div>

                        <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-r-xl">
                            <h4 class="font-bold text-red-800 mb-2 flex items-center">
                                <i data-lucide="alert-triangle" class="w-5 h-5 mr-2"></i> Kriteria Diskualifikasi
                            </h4>
                            <p class="text-sm text-red-700 mb-3">Panitia berhak secara sepihak membatalkan keikutsertaan peserta apabila ditemukan pelanggaran berikut:</p>
                            <ul class="space-y-2 text-sm text-red-700 list-disc list-outside ml-5">
                                <li>Karya terbukti bukan hasil foto sendiri (plagiarisme).</li>
                                <li>Melakukan manipulasi digital yang dilarang (Lihat tab Aturan Editing).</li>
                                <li>Terindikasi menggunakan teknologi AI generatif.</li>
                                <li>Menggunakan data atau identitas pribadi palsu.</li>
                                <li>Foto terbukti tidak sesuai tema, atau melanggar norma dan etika yang berlaku.</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Tab: Aturan Editing -->
                    <div x-show="activeTab === 'editing'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-cloak class="space-y-8">
                        <p class="text-gray-600 text-lg leading-relaxed mb-8">
                            Kompetisi ini menjunjung tinggi orisinalitas momen. Proses editing diperbolehkan hanya dalam batasan kamar gelap digital (digital darkroom) untuk mengoptimalkan visual, bukan memanipulasi kenyataan.
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="bg-green-50 border border-green-100 p-8 rounded-2xl">
                                <h4 class="font-bold text-green-800 mb-4 flex items-center text-xl">
                                    <i data-lucide="check-circle-2" class="w-6 h-6 mr-2"></i> Diperbolehkan
                                </h4>
                                <ul class="space-y-3 text-green-700">
                                    <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 mr-2"></i> Cropping (Pemotongan) proporsional</li>
                                    <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 mr-2"></i> Penyesuaian Exposure / Contrast</li>
                                    <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 mr-2"></i> White Balance & Color Correction</li>
                                    <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 mr-2"></i> Konversi Black & White (B&W)</li>
                                    <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 mr-2"></i> Sharpening standar</li>
                                    <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 mr-2"></i> Noise reduction wajar</li>
                                </ul>
                            </div>
                            
                            <div class="bg-red-50 border border-red-100 p-8 rounded-2xl">
                                <h4 class="font-bold text-red-800 mb-4 flex items-center text-xl">
                                    <i data-lucide="x-circle" class="w-6 h-6 mr-2"></i> Dilarang Keras
                                </h4>
                                <ul class="space-y-3 text-red-700">
                                    <li class="flex items-center"><i data-lucide="x" class="w-4 h-4 mr-2"></i> Penggunaan AI Generatif</li>
                                    <li class="flex items-center"><i data-lucide="x" class="w-4 h-4 mr-2"></i> Compositing (Menggabungkan foto)</li>
                                    <li class="flex items-center"><i data-lucide="x" class="w-4 h-4 mr-2"></i> Menambah/Menghapus elemen objek</li>
                                    <li class="flex items-center"><i data-lucide="x" class="w-4 h-4 mr-2"></i> Sky Replacement</li>
                                    <li class="flex items-center"><i data-lucide="x" class="w-4 h-4 mr-2"></i> Menambahkan Watermark / Tulisan</li>
                                    <li class="flex items-center"><i data-lucide="x" class="w-4 h-4 mr-2"></i> Menambahkan Bingkai (Border)</li>
                                </ul>
                            </div>
                        </div>

                        <div class="mt-8 p-6 bg-yellow-50 border border-yellow-200 rounded-xl flex items-start">
                            <i data-lucide="info" class="w-6 h-6 text-yellow-600 mr-4 mt-1 flex-shrink-0"></i>
                            <p class="text-yellow-800 text-sm">
                                <strong>Verifikasi File Asli:</strong> Panitia akan meminta file asli (RAW/JPEG Original/Metadata utuh) dari foto-foto yang masuk ke tahap final. Ketidakmampuan menyediakan file asli dapat berakibat pada diskualifikasi.
                            </p>
                        </div>
                    </div>

                    <!-- Tab: Penilaian -->
                    <div x-show="activeTab === 'penilaian'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-cloak class="space-y-12">
                        <div class="bg-dark text-white p-6 rounded-2xl mb-8 flex items-center justify-between">
                            <div>
                                <h3 class="font-heading text-2xl mb-1">Total Nilai Maksimal: 100</h3>
                                <p class="text-gray-400 text-sm">Semua foto dinilai menggunakan metode Blind Judging (identitas disembunyikan).</p>
                            </div>
                            <div class="w-16 h-16 bg-gold rounded-full flex items-center justify-center">
                                <i data-lucide="check-square" class="w-8 h-8 text-dark"></i>
                            </div>
                        </div>

                        <!-- Rubrik 1 -->
                        <div>
                            <div class="flex justify-between items-end mb-3 border-b border-gray-200 pb-2">
                                <h4 class="font-heading text-xl text-dark">1. Kesesuaian Tema & Narasi</h4>
                                <span class="text-gold font-bold bg-gold/10 px-3 py-1 rounded-full text-sm">Maks: 30 Poin</span>
                            </div>
                            <ul class="space-y-3 text-sm text-gray-600 list-disc list-outside ml-5">
                                <li><strong>25 – 30 Poin:</strong> Sosok yang dipotret sangat jelas kontribusinya bagi lingkungan/Paser, relevan dengan semangat mengisi kemerdekaan, dan narasi menceritakan dedikasinya dengan sangat baik.</li>
                                <li><strong>15 – 24 Poin:</strong> Sosok relevan, namun hubungan dengan semangat kemerdekaan atau latar belakang khas Paser kurang kuat.</li>
                                <li><strong>&lt; 15 Poin:</strong> Hubungan sosok dengan tema lemah, atau cerita tidak tersampaikan.</li>
                            </ul>
                        </div>

                        <!-- Rubrik 2 -->
                        <div>
                            <div class="flex justify-between items-end mb-3 border-b border-gray-200 pb-2">
                                <h4 class="font-heading text-xl text-dark">2. Komposisi & Estetika Visual</h4>
                                <span class="text-gold font-bold bg-gold/10 px-3 py-1 rounded-full text-sm">Maks: 25 Poin</span>
                            </div>
                            <ul class="space-y-3 text-sm text-gray-600 list-disc list-outside ml-5">
                                <li><strong>21 – 25 Poin:</strong> Sudut pengambilan (angle) sangat kreatif, objek utama langsung menarik perhatian, latar belakang mendukung tanpa mengganggu.</li>
                                <li><strong>11 – 20 Poin:</strong> Komposisi standar (umum), posisi objek utama cukup baik namun kurang dinamis.</li>
                                <li><strong>&lt; 10 Poin:</strong> Komposisi berantakan, membingungkan, atau objek terpotong tidak disengaja.</li>
                            </ul>
                        </div>

                        <!-- Rubrik 3 -->
                        <div>
                            <div class="flex justify-between items-end mb-3 border-b border-gray-200 pb-2">
                                <h4 class="font-heading text-xl text-dark">3. Teknis Fotografi</h4>
                                <span class="text-gold font-bold bg-gold/10 px-3 py-1 rounded-full text-sm">Maks: 20 Poin</span>
                            </div>
                            <p class="text-xs text-gray-500 italic mb-3">*Untuk Kategori Smartphone, toleransi noise/sensor disesuaikan, ketajaman objek tetap jadi fokus utama.</p>
                            <ul class="space-y-3 text-sm text-gray-600 list-disc list-outside ml-5">
                                <li><strong>16 – 20 Poin:</strong> Gambar tajam di area krusial (mata/wajah), pencahayaan pas, warna natural.</li>
                                <li><strong>10 – 15 Poin:</strong> Ada sedikit misfokus atau pencahayaan kurang seimbang, momen masih terselamatkan.</li>
                                <li><strong>&lt; 10 Poin:</strong> Foto buram parah (goyang) atau terlalu gelap/terang hingga detail hilang.</li>
                            </ul>
                        </div>

                        <!-- Rubrik 4 -->
                        <div>
                            <div class="flex justify-between items-end mb-3 border-b border-gray-200 pb-2">
                                <h4 class="font-heading text-xl text-dark">4. Dampak Emosional, Martabat & Inspirasi</h4>
                                <span class="text-gold font-bold bg-gold/10 px-3 py-1 rounded-full text-sm">Maks: 25 Poin</span>
                            </div>
                            <ul class="space-y-3 text-sm text-gray-600 list-disc list-outside ml-5">
                                <li><strong>21 – 25 Poin:</strong> Menangkap momen emas, memancarkan harga diri/martabat tinggi, sangat menginspirasi.</li>
                                <li><strong>11 – 20 Poin:</strong> Ekspresi objek datar, momen kurang kuat menggerakkan emosi penonton.</li>
                                <li><strong>&lt; 10 Poin:</strong> Mengeksploitasi kesedihan berlebihan (poverty porn) atau objek terlihat tidak nyaman.</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            
            <div class="mt-12 text-center" data-aos="fade-up">
                <a href="{{ url('/register') }}" class="inline-block bg-dark text-white px-10 py-4 rounded-full font-bold text-lg hover:bg-gold hover:text-dark transition-colors shadow-lg">
                    Saya Sudah Membaca & Ingin Mendaftar
                </a>
            </div>
        </div>
    </section>
</x-layouts.app>
