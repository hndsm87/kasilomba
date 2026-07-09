<x-layouts.app title="FAQ | Kasiinfo Photo Challenge 2026">
    <header class="pt-32 pb-20 bg-dark text-white text-center border-b border-gray-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-heading text-5xl md:text-7xl mb-4" data-aos="fade-up">Frequently Asked Questions</h1>
            <p class="text-xl text-gray-300" data-aos="fade-up" data-aos-delay="100">Got questions? We've got answers.</p>
        </div>
    </header>

    <section class="py-24 bg-white" x-data="{ search: '' }">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Search -->
            <div class="relative mb-12" data-aos="fade-up">
                <i data-lucide="search" class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5"></i>
                <input type="text" x-model="search" placeholder="Search questions..." class="w-full pl-12 pr-4 py-4 rounded-full border border-gray-200 focus:border-gold focus:ring-1 focus:ring-gold outline-none transition-all duration-300 shadow-sm">
            </div>

            <!-- FAQ List -->
            <div class="space-y-2">
                <div x-show="'Can I submit more than one photo?'.toLowerCase().includes(search.toLowerCase())">
                    <x-ui.accordion title="Can I submit more than one photo?">
                        No. Each participant is strictly limited to one (1) photo submission. Choose your best work.
                    </x-ui.accordion>
                </div>
                
                <div x-show="'Is the competition free to enter?'.toLowerCase().includes(search.toLowerCase())">
                    <x-ui.accordion title="Is the competition free to enter?">
                        Yes! The Kasiinfo Photo Challenge is 100% free of charge. Be wary of anyone asking for registration fees on our behalf.
                    </x-ui.accordion>
                </div>

                <div x-show="'What kind of editing is allowed?'.toLowerCase().includes(search.toLowerCase())">
                    <x-ui.accordion title="What kind of editing is allowed?">
                        Basic editing such as adjusting brightness, contrast, saturation, cropping, and color correction is allowed. Manipulation like adding or removing objects, composites, or using AI generative tools is strictly prohibited and will lead to immediate disqualification.
                    </x-ui.accordion>
                </div>

                <div x-show="'I am not from Paser but I took a photo in Paser. Can I join?'.toLowerCase().includes(search.toLowerCase())">
                    <x-ui.accordion title="I am not from Paser but I took a photo in Paser. Can I join?">
                        No. The competition is strictly for residents or natives of Kabupaten Paser. You will need to provide a KTP or Kartu Pelajar as proof of residency during registration.
                    </x-ui.accordion>
                </div>

                <div x-show="'Can I use a drone?'.toLowerCase().includes(search.toLowerCase())">
                    <x-ui.accordion title="Can I use a drone?">
                        No. Drones and aerial photography are prohibited in both the Smartphone and DSLR/Mirrorless categories for this year's challenge to maintain a level playing field focused on ground-level human interest.
                    </x-ui.accordion>
                </div>

                <div x-show="'When is the deadline?'.toLowerCase().includes(search.toLowerCase())">
                    <x-ui.accordion title="When is the deadline?">
                        The registration and submission phase closes on September 15, 2026, at 23:59 WITA. Late submissions will not be accepted.
                    </x-ui.accordion>
                </div>
                
                <!-- Empty State -->
                <div x-show="search !== '' && document.querySelectorAll('[x-show]:not([style*=\'display: none\'])').length === 1" class="text-center py-8 text-gray-500" x-cloak>
                    No matching questions found for "<span x-text="search" class="font-bold"></span>".
                </div>
            </div>

            <!-- Contact Support CTA -->
            <div class="mt-16 text-center border-t border-gray-100 pt-16" data-aos="fade-up">
                <p class="text-gray-600 mb-4">Still have questions?</p>
                <a href="{{ url('/contact') }}" class="inline-flex items-center text-dark font-bold hover:text-gold transition-colors">
                    Contact our support team <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                </a>
            </div>

        </div>
    </section>
</x-layouts.app>
