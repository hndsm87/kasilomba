<x-layouts.app title="Guidebook | Kasiinfo Photo Challenge 2026">
    <header class="pt-32 pb-20 bg-dark text-white text-center">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-heading text-5xl md:text-7xl mb-4" data-aos="fade-up">Official Guidebook</h1>
            <p class="text-xl text-gray-300 mb-8" data-aos="fade-up" data-aos-delay="100">Everything you need to know to participate and win.</p>
            <a href="#" class="inline-flex items-center bg-gold text-dark px-8 py-3 rounded-full font-bold hover:bg-white transition-colors duration-300" data-aos="fade-up" data-aos-delay="200">
                <i data-lucide="download" class="w-5 h-5 mr-2"></i> Download PDF Version
            </a>
        </div>
    </header>

    <section class="py-16 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-12">
                
                <!-- Sticky TOC -->
                <aside class="lg:w-1/4 hidden lg:block">
                    <div class="sticky top-24 border-l-2 border-gray-100 pl-6 py-2">
                        <h4 class="font-heading text-xl mb-6 text-dark tracking-wider">Contents</h4>
                        <nav class="space-y-4" x-data="{ active: 'requirements' }" @scroll.window="
                            const sections = ['requirements', 'rules', 'judging', 'disqualification'];
                            let current = 'requirements';
                            for(const section of sections) {
                                const el = document.getElementById(section);
                                if(el && window.scrollY >= (el.offsetTop - 150)) {
                                    current = section;
                                }
                            }
                            active = current;
                        ">
                            <a href="#requirements" class="block text-sm transition-colors duration-200" :class="active === 'requirements' ? 'text-gold font-bold' : 'text-gray-500 hover:text-dark'">1. General Requirements</a>
                            <a href="#rules" class="block text-sm transition-colors duration-200" :class="active === 'rules' ? 'text-gold font-bold' : 'text-gray-500 hover:text-dark'">2. Competition Rules</a>
                            <a href="#judging" class="block text-sm transition-colors duration-200" :class="active === 'judging' ? 'text-gold font-bold' : 'text-gray-500 hover:text-dark'">3. Judging Criteria</a>
                            <a href="#disqualification" class="block text-sm transition-colors duration-200" :class="active === 'disqualification' ? 'text-gold font-bold' : 'text-gray-500 hover:text-dark'">4. Disqualification</a>
                        </nav>
                    </div>
                </aside>

                <!-- Content -->
                <div class="lg:w-3/4 max-w-3xl prose prose-lg prose-headings:font-heading prose-headings:text-dark prose-a:text-gold hover:prose-a:text-yellow-500">
                    
                    <div id="requirements" class="mb-16 scroll-mt-24">
                        <h2 class="text-4xl border-b pb-4 mb-6">1. General Requirements</h2>
                        <ul class="space-y-3">
                            <li class="flex items-start"><i data-lucide="check-circle-2" class="w-6 h-6 text-gold mr-3 flex-shrink-0 mt-1"></i> <span>Participants must be residents or natives of Kabupaten Paser (proven by KTP/Kartu Pelajar).</span></li>
                            <li class="flex items-start"><i data-lucide="check-circle-2" class="w-6 h-6 text-gold mr-3 flex-shrink-0 mt-1"></i> <span>Each participant is considered as a single individual (no group submissions).</span></li>
                            <li class="flex items-start"><i data-lucide="check-circle-2" class="w-6 h-6 text-gold mr-3 flex-shrink-0 mt-1"></i> <span>A participant may only enter one (1) category.</span></li>
                            <li class="flex items-start"><i data-lucide="check-circle-2" class="w-6 h-6 text-gold mr-3 flex-shrink-0 mt-1"></i> <span>Registration is strictly done through the official website and is completely free of charge.</span></li>
                        </ul>
                    </div>

                    <div id="rules" class="mb-16 scroll-mt-24">
                        <h2 class="text-4xl border-b pb-4 mb-6">2. Competition Rules</h2>
                        <div class="bg-gray-50 p-6 rounded-xl mb-6 border border-gray-100">
                            <h4 class="text-lg font-bold text-dark mb-2">Photo Specifications</h4>
                            <p class="text-gray-600 mb-0">Each participant can only submit exactly one (1) photo for the competition.</p>
                        </div>
                        <ul class="space-y-3 text-gray-700">
                            <li><strong>Timeframe:</strong> The photo must have been taken within the year 2026.</li>
                            <li><strong>Location:</strong> The photo must be taken strictly within the geographical boundaries of Kabupaten Paser.</li>
                            <li><strong>Previous Competitions:</strong> The photo may have been entered in other competitions previously, provided it has never won any award or placement.</li>
                            <li><strong>Permissions:</strong> The photographer holds full responsibility for obtaining necessary permissions from any recognizable subjects in the photograph. The organizer is absolved of any legal disputes regarding subject privacy.</li>
                            <li><strong>Post-Processing:</strong> Basic editing (brightness, contrast, cropping, color correction) is allowed. Manipulation (adding/removing elements, AI generation) is strictly prohibited.</li>
                        </ul>
                    </div>

                    <div id="judging" class="mb-16 scroll-mt-24">
                        <h2 class="text-4xl border-b pb-4 mb-6">3. Judging Criteria</h2>
                        <p class="text-gray-700 mb-6">Our panel of professional judges will evaluate submissions based on the following criteria:</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="p-6 border border-gray-200 rounded-xl">
                                <h4 class="font-bold text-dark mb-2 text-xl">Relevance (30%)</h4>
                                <p class="text-sm text-gray-600">How well the photo interprets and executes the theme "Roda Juang Bumi Paser".</p>
                            </div>
                            <div class="p-6 border border-gray-200 rounded-xl">
                                <h4 class="font-bold text-dark mb-2 text-xl">Composition (30%)</h4>
                                <p class="text-sm text-gray-600">Visual balance, framing, leading lines, and overall aesthetic arrangement.</p>
                            </div>
                            <div class="p-6 border border-gray-200 rounded-xl">
                                <h4 class="font-bold text-dark mb-2 text-xl">Technical (20%)</h4>
                                <p class="text-sm text-gray-600">Focus, exposure, lighting, and appropriate use of the chosen equipment.</p>
                            </div>
                            <div class="p-6 border border-gray-200 rounded-xl">
                                <h4 class="font-bold text-dark mb-2 text-xl">Impact (20%)</h4>
                                <p class="text-sm text-gray-600">The emotional response, storytelling power, and the "wow" factor of the image.</p>
                            </div>
                        </div>
                    </div>

                    <div id="disqualification" class="mb-16 scroll-mt-24">
                        <h2 class="text-4xl border-b pb-4 mb-6 text-kasi-red">4. Disqualification</h2>
                        <p class="text-gray-700">Participants will be immediately disqualified without notice if they violate any of the following:</p>
                        <ul class="list-disc pl-5 text-gray-700 space-y-2 mt-4 marker:text-kasi-red">
                            <li>Plagiarism or submitting someone else's work.</li>
                            <li>Use of Artificial Intelligence (AI) to generate or significantly alter the image.</li>
                            <li>Adding or removing significant elements from the original frame (compositing).</li>
                            <li>Submitting a photo taken outside of Kabupaten Paser.</li>
                            <li>Falsifying identification documents (KTP/Kartu Pelajar).</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
