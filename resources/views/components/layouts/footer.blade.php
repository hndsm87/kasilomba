<footer class="bg-dark text-white pt-20 pb-10 border-t border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
            <!-- Brand -->
            <div class="col-span-1 md:col-span-1">
                <a href="{{ url('/') }}" class="font-heading text-3xl tracking-widest font-bold mb-4 block">
                    KASIINFO<span class="text-gold">.</span>
                </a>
                <p class="text-gray-400 text-sm leading-relaxed mb-6">
                    "Dari tangan-tangan sederhana lahir kemajuan Bumi Paser."
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-gold transition-colors">
                        <i data-lucide="instagram" class="w-5 h-5"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gold transition-colors">
                        <i data-lucide="facebook" class="w-5 h-5"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gold transition-colors">
                        <i data-lucide="youtube" class="w-5 h-5"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="font-heading text-xl mb-6 tracking-wide text-gray-200">Competition</h4>
                <ul class="space-y-3">
                    <li><a href="{{ url('/about') }}" class="text-gray-400 hover:text-white transition-colors text-sm">About Challenge</a></li>
                    <li><a href="{{ url('/categories') }}" class="text-gray-400 hover:text-white transition-colors text-sm">Categories</a></li>
                    <li><a href="{{ url('/prizes') }}" class="text-gray-400 hover:text-white transition-colors text-sm">Prizes</a></li>
                    <li><a href="{{ url('/timeline') }}" class="text-gray-400 hover:text-white transition-colors text-sm">Timeline</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h4 class="font-heading text-xl mb-6 tracking-wide text-gray-200">Support</h4>
                <ul class="space-y-3">
                    <li><a href="{{ url('/guidebook') }}" class="text-gray-400 hover:text-white transition-colors text-sm">Guidebook</a></li>
                    <li><a href="{{ url('/join') }}" class="text-gray-400 hover:text-white transition-colors text-sm">How to Join</a></li>
                    <li><a href="{{ url('/faq') }}" class="text-gray-400 hover:text-white transition-colors text-sm">FAQ</a></li>
                    <li><a href="{{ url('/contact') }}" class="text-gray-400 hover:text-white transition-colors text-sm">Contact Us</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="font-heading text-xl mb-6 tracking-wide text-gray-200">Contact</h4>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <i data-lucide="map-pin" class="w-5 h-5 text-gold mr-3 mt-0.5 flex-shrink-0"></i>
                        <span class="text-gray-400 text-sm">Kabupaten Paser, Kalimantan Timur, Indonesia</span>
                    </li>
                    <li class="flex items-center">
                        <i data-lucide="mail" class="w-5 h-5 text-gold mr-3 flex-shrink-0"></i>
                        <a href="mailto:hello@kasiinfo.id" class="text-gray-400 hover:text-white transition-colors text-sm">hello@kasiinfo.id</a>
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
                &copy; {{ date('Y') }} Kasiinfo Photo Challenge. All rights reserved.
            </p>
            <div class="flex space-x-6 text-sm text-gray-500">
                <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
