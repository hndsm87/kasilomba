<x-layouts.app title="About | Kasiinfo Photo Challenge 2026">
    <!-- Header -->
    <header class="pt-32 pb-20 bg-dark text-white relative overflow-hidden">
        <div class="absolute inset-0 z-0 opacity-30">
            <img src="https://images.unsplash.com/photo-1542038784456-1ea8e935640e?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover grayscale" alt="Background">
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="font-heading text-5xl md:text-7xl mb-4" data-aos="fade-up">About The Challenge</h1>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">Discover the purpose and the vision behind the biggest photography event in Paser.</p>
        </div>
    </header>

    <!-- Theme Explanation -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                <div data-aos="fade-right">
                    <span class="text-gold font-bold tracking-wider text-sm uppercase mb-3 block">The Theme</span>
                    <h2 class="font-heading text-5xl mb-6 text-dark">Roda Juang Bumi Paser</h2>
                    <div class="space-y-4 text-gray-600 leading-relaxed text-lg text-justify">
                        <p>
                            "Dari tangan-tangan sederhana lahir kemajuan Bumi Paser." This is more than just a tagline; it is a profound acknowledgment of the silent heroes who build our community every day.
                        </p>
                        <p>
                            We are looking for photographs that capture the essence of hard work, perseverance, and the human spirit. We want to see the faces, the sweat, the tools, and the environments where progress is born. 
                        </p>
                        <p>
                            Show us the farmers in the early morning mist, the artisans crafting traditional goods, the builders, the teachers, and the everyday people whose simple, yet vital contributions are the very foundation of Kabupaten Paser's advancement.
                        </p>
                    </div>
                </div>
                <div class="relative" data-aos="fade-left">
                    <div class="aspect-square rounded-full overflow-hidden shadow-2xl relative z-10">
                        <img src="https://images.unsplash.com/photo-1541888014768-45e0fb14b1cc?q=80&w=1974&auto=format&fit=crop" alt="Hard work" class="w-full h-full object-cover">
                    </div>
                    <div class="absolute -bottom-10 -left-10 w-48 h-48 bg-gold rounded-full filter blur-3xl opacity-30 -z-0"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="py-24 bg-gray-50 border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div class="bg-white p-12 rounded-3xl shadow-lg border border-gray-100 hover:-translate-y-2 transition-transform duration-500" data-aos="fade-up">
                    <div class="w-16 h-16 bg-gold/10 rounded-2xl flex items-center justify-center mb-8">
                        <i data-lucide="target" class="w-8 h-8 text-gold"></i>
                    </div>
                    <h3 class="font-heading text-4xl mb-4">Our Mission</h3>
                    <p class="text-gray-600 leading-relaxed text-lg">
                        To provide a prestigious platform for photographers of all levels to showcase their talent, tell powerful stories about Kabupaten Paser, and elevate the local creative industry to national standards.
                    </p>
                </div>
                
                <div class="bg-white p-12 rounded-3xl shadow-lg border border-gray-100 hover:-translate-y-2 transition-transform duration-500" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-kasi-red/10 rounded-2xl flex items-center justify-center mb-8">
                        <i data-lucide="eye" class="w-8 h-8 text-kasi-red"></i>
                    </div>
                    <h3 class="font-heading text-4xl mb-4">Our Vision</h3>
                    <p class="text-gray-600 leading-relaxed text-lg">
                        To become the definitive visual archive of Kabupaten Paser's cultural and economic progress, recognized as a premier photography competition in Indonesia.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Official Organizer -->
    <section class="py-24 bg-white text-center">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-gold font-bold tracking-wider text-sm uppercase mb-3 block" data-aos="fade-up">The Organizer</span>
            <h2 class="font-heading text-5xl mb-8 text-dark" data-aos="fade-up" data-aos-delay="100">Kasiinfo ID</h2>
            
            <p class="text-xl text-gray-600 leading-relaxed mb-12" data-aos="fade-up" data-aos-delay="200">
                Kasiinfo ID is the leading digital media platform in Kabupaten Paser. We are dedicated to delivering accurate information, promoting local potential, and fostering community growth. This competition exists because we believe that every corner of Paser has a story waiting to be told through the lens.
            </p>
            
            <a href="{{ url('/contact') }}" class="inline-flex items-center bg-dark text-white px-8 py-3 rounded-full font-bold hover:bg-gold hover:text-dark transition-colors duration-300" data-aos="fade-up" data-aos-delay="300">
                Contact Organizer
            </a>
        </div>
    </section>
</x-layouts.app>
