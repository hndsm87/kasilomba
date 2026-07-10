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
                    <a href="https://instagram.com/kasiinfo.id" target="_blank" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-gold hover:text-dark transition-colors" title="Instagram">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                    <a href="https://tiktok.com/@kasiinfo.id" target="_blank" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-gold hover:text-dark transition-colors" title="TikTok">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.01.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.12-3.44-3.17-3.8-5.46-.4-2.51.33-5.23 2.1-7.05 1.5-1.52 3.65-2.3 5.75-2.09-.03 1.44-.05 2.87-.07 4.31-1.07-.1-2.14.07-3.08.57-1.12.59-1.93 1.72-2.13 2.98-.22 1.44.22 2.96 1.25 3.95 1.05.99 2.65 1.3 4.04.91 1.42-.4 2.52-1.6 2.76-3.04.2-1.22.18-2.46.18-3.69-.02-4.83-.02-9.66-.02-14.49Z"/></svg>
                    </a>
                    <a href="https://youtube.com/@kasiinfo.id" target="_blank" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-gold hover:text-dark transition-colors" title="YouTube">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
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
