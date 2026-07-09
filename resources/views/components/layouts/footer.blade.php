<footer class="bg-dark text-white pt-20 pb-10 border-t border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12 border-b border-gray-800 pb-12">
            
            <!-- Brand -->
            <div class="col-span-1 md:col-span-1">
                <a href="{{ url('/') }}" class="flex items-center mb-6">
                    <img src="{{ asset('images/logo.png') }}" alt="Kasiinfo Logo" class="h-10">
                </a>
                <p class="text-gray-400 text-sm leading-relaxed mb-6">
                    Platform informasi terdepan di Kabupaten Paser. Menghubungkan, menginspirasi, dan memberdayakan komunitas melalui konten yang relevan dan otentik.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-gold hover:text-dark transition-colors">
                        <i data-lucide="instagram" class="w-5 h-5"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-gold hover:text-dark transition-colors">
                        <i data-lucide="twitter" class="w-5 h-5"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-gold hover:text-dark transition-colors">
                        <i data-lucide="facebook" class="w-5 h-5"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-white font-bold mb-6 tracking-wider uppercase text-sm">Tautan Cepat</h4>
                <ul class="space-y-4">
                    <li><a href="{{ url('/about') }}" class="text-gray-400 hover:text-gold transition-colors text-sm flex items-center"><i data-lucide="chevron-right" class="w-4 h-4 mr-2"></i> Tentang Kompetisi</a></li>
                    <li><a href="{{ url('/categories') }}" class="text-gray-400 hover:text-gold transition-colors text-sm flex items-center"><i data-lucide="chevron-right" class="w-4 h-4 mr-2"></i> Kategori</a></li>
                    <li><a href="{{ url('/prizes') }}" class="text-gray-400 hover:text-gold transition-colors text-sm flex items-center"><i data-lucide="chevron-right" class="w-4 h-4 mr-2"></i> Hadiah</a></li>
                    <li><a href="{{ url('/timeline') }}" class="text-gray-400 hover:text-gold transition-colors text-sm flex items-center"><i data-lucide="chevron-right" class="w-4 h-4 mr-2"></i> Jadwal</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h4 class="text-white font-bold mb-6 tracking-wider uppercase text-sm">Bantuan</h4>
                <ul class="space-y-4">
                    <li><a href="{{ url('/guidebook') }}" class="text-gray-400 hover:text-gold transition-colors text-sm flex items-center"><i data-lucide="chevron-right" class="w-4 h-4 mr-2"></i> Panduan Lengkap</a></li>
                    <li><a href="{{ url('/join') }}" class="text-gray-400 hover:text-gold transition-colors text-sm flex items-center"><i data-lucide="chevron-right" class="w-4 h-4 mr-2"></i> Cara Bergabung</a></li>
                    <li><a href="{{ url('/faq') }}" class="text-gray-400 hover:text-gold transition-colors text-sm flex items-center"><i data-lucide="chevron-right" class="w-4 h-4 mr-2"></i> FAQ</a></li>
                    <li><a href="{{ url('/contact') }}" class="text-gray-400 hover:text-gold transition-colors text-sm flex items-center"><i data-lucide="chevron-right" class="w-4 h-4 mr-2"></i> Kontak Kami</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="text-white font-bold mb-6 tracking-wider uppercase text-sm">Kontak</h4>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <i data-lucide="map-pin" class="w-5 h-5 text-gold mr-3 mt-0.5 flex-shrink-0"></i>
                        <span class="text-gray-400 text-sm">Tanah Grogot, Kabupaten Paser, Kalimantan Timur, Indonesia</span>
                    </li>
                    <li class="flex items-center">
                        <i data-lucide="mail" class="w-5 h-5 text-gold mr-3 flex-shrink-0"></i>
                        <span class="text-gray-400 text-sm">halo@kasiinfo.id</span>
                    </li>
                    <li class="flex items-center">
                        <i data-lucide="phone" class="w-5 h-5 text-gold mr-3 flex-shrink-0"></i>
                        <span class="text-gray-400 text-sm">+62 812 3456 7890</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-gray-500 text-sm mb-4 md:mb-0">
                &copy; 2026 Kasiinfo.id. Hak Cipta Dilindungi Undang-Undang.
            </p>
            <div class="flex space-x-6 text-sm">
                <a href="#" class="text-gray-500 hover:text-white transition-colors">Kebijakan Privasi</a>
                <a href="#" class="text-gray-500 hover:text-white transition-colors">Syarat & Ketentuan</a>
            </div>
        </div>
    </div>
</footer>
