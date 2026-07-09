<x-layouts.app title="How to Join | Kasiinfo Photo Challenge 2026">
    <header class="pt-32 pb-20 bg-dark text-white text-center border-b border-gray-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-heading text-5xl md:text-7xl mb-4" data-aos="fade-up">How To Join</h1>
            <p class="text-xl text-gray-300" data-aos="fade-up" data-aos-delay="100">Follow these simple steps to enter the competition.</p>
        </div>
    </header>

    <section class="py-24 bg-white" x-data="{ step: 1 }">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Stepper Navigation (Desktop) -->
            <div class="hidden md:flex justify-between items-center mb-16 relative">
                <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-full h-1 bg-gray-200 z-0"></div>
                <div class="absolute left-0 top-1/2 transform -translate-y-1/2 h-1 bg-gold z-0 transition-all duration-500" :style="'width: ' + ((step - 1) * 25) + '%'"></div>

                <template x-for="i in 5" :key="i">
                    <button @click="step = i" class="relative z-10 w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg transition-all duration-300 focus:outline-none"
                            :class="step >= i ? 'bg-gold text-dark shadow-[0_0_15px_rgba(212,175,55,0.6)] scale-110' : 'bg-white border-2 border-gray-300 text-gray-400 hover:border-gold'">
                        <span x-text="i"></span>
                    </button>
                </template>
            </div>

            <!-- Stepper Content -->
            <div class="bg-gray-50 rounded-3xl p-8 md:p-12 shadow-lg border border-gray-100 relative min-h-[400px]">
                
                <!-- Step 1 -->
                <div x-show="step === 1" x-transition.opacity.duration.500ms class="absolute inset-0 p-8 md:p-12 flex flex-col justify-center text-center">
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm">
                        <i data-lucide="book-open" class="w-10 h-10 text-dark"></i>
                    </div>
                    <h3 class="font-heading text-4xl text-dark mb-4">Read Guidebook</h3>
                    <p class="text-gray-600 text-lg max-w-2xl mx-auto mb-8">Before doing anything else, make sure you thoroughly read the official guidebook. Understand the theme, rules, and requirements to avoid disqualification.</p>
                    <div>
                        <a href="{{ url('/guidebook') }}" class="inline-block bg-dark text-white px-8 py-3 rounded-full font-bold hover:bg-gold hover:text-dark transition-colors duration-300">Read Guidebook</a>
                    </div>
                </div>

                <!-- Step 2 -->
                <div x-show="step === 2" x-cloak x-transition.opacity.duration.500ms class="absolute inset-0 p-8 md:p-12 flex flex-col justify-center text-center">
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm">
                        <i data-lucide="file-text" class="w-10 h-10 text-dark"></i>
                    </div>
                    <h3 class="font-heading text-4xl text-dark mb-4">Fill Registration Form</h3>
                    <p class="text-gray-600 text-lg max-w-2xl mx-auto mb-8">Go to the registration page and fill out the official form. You will need to provide your personal details, category selection, and upload a photo of your KTP or Kartu Pelajar.</p>
                </div>

                <!-- Step 3 -->
                <div x-show="step === 3" x-cloak x-transition.opacity.duration.500ms class="absolute inset-0 p-8 md:p-12 flex flex-col justify-center text-center">
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm">
                        <i data-lucide="upload-cloud" class="w-10 h-10 text-dark"></i>
                    </div>
                    <h3 class="font-heading text-4xl text-dark mb-4">Upload Photo</h3>
                    <p class="text-gray-600 text-lg max-w-2xl mx-auto mb-8">Within the same registration form, upload your final photo submission. Ensure the file size and format match the requirements stated in the form.</p>
                </div>

                <!-- Step 4 -->
                <div x-show="step === 4" x-cloak x-transition.opacity.duration.500ms class="absolute inset-0 p-8 md:p-12 flex flex-col justify-center text-center">
                    <div class="w-20 h-20 bg-gradient-to-tr from-yellow-400 via-red-500 to-purple-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm">
                        <i data-lucide="instagram" class="w-10 h-10 text-white"></i>
                    </div>
                    <h3 class="font-heading text-4xl text-dark mb-4">Upload to Instagram</h3>
                    <p class="text-gray-600 text-lg max-w-2xl mx-auto mb-6">After submitting the form, post the exact same photo to your public Instagram account.</p>
                    <div class="bg-white p-4 rounded-xl border border-gray-200 inline-block text-left mx-auto">
                        <p class="font-bold text-dark mb-2">You must include:</p>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>Tag: <span class="text-blue-600">@kasiinfo.id</span></li>
                            <li>Hashtags: <span class="text-blue-600">#KasiinfoPhotoChallenge2026 #RodaJuangBumiPaser #KasiinfoID</span></li>
                        </ul>
                    </div>
                </div>

                <!-- Step 5 -->
                <div x-show="step === 5" x-cloak x-transition.opacity.duration.500ms class="absolute inset-0 p-8 md:p-12 flex flex-col justify-center text-center">
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm">
                        <i data-lucide="check-circle" class="w-10 h-10 text-green-600"></i>
                    </div>
                    <h3 class="font-heading text-4xl text-dark mb-4">Registration Complete</h3>
                    <p class="text-gray-600 text-lg max-w-2xl mx-auto mb-8">You are all set! Your submission is now recorded. Keep an eye on your email and our Instagram for the Top 10 announcements.</p>
                    <div>
                        <a href="{{ url('/register') }}" class="inline-block bg-gold text-dark px-10 py-4 rounded-full font-bold text-lg hover:bg-yellow-500 hover:scale-105 transition-all duration-300 shadow-lg">Start Registration</a>
                    </div>
                </div>
            </div>

            <!-- Stepper Controls -->
            <div class="flex justify-between mt-8">
                <button @click="if(step > 1) step--" :class="{ 'opacity-50 cursor-not-allowed': step === 1 }" class="flex items-center text-dark font-bold hover:text-gold transition-colors">
                    <i data-lucide="arrow-left" class="w-5 h-5 mr-2"></i> Previous Step
                </button>
                <button @click="if(step < 5) step++" x-show="step < 5" class="flex items-center text-dark font-bold hover:text-gold transition-colors">
                    Next Step <i data-lucide="arrow-right" class="w-5 h-5 ml-2"></i>
                </button>
            </div>

        </div>
    </section>
</x-layouts.app>
