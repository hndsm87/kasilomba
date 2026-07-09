<x-layouts.admin title="Judge Dashboard">
    <div class="p-8 max-w-7xl mx-auto flex flex-col items-center justify-center min-h-[80vh] text-center">
        
        <div class="mb-8" data-aos="fade-down">
            <div class="w-24 h-24 bg-gray-900 border border-gray-800 rounded-full flex items-center justify-center mx-auto mb-6 shadow-2xl">
                <i data-lucide="camera" class="w-10 h-10 text-gold"></i>
            </div>
            <h1 class="text-4xl font-heading text-white tracking-widest mb-2">JUDGING QUEUE</h1>
            <p class="text-gray-400 max-w-lg mx-auto">Welcome to the official judging portal. Please review the photographs carefully based on the specified criteria.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-4xl mb-12" data-aos="fade-up" data-aos-delay="100">
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-lg">
                <h3 class="text-5xl font-bold text-white mb-2">{{ $totalPhotos }}</h3>
                <p class="text-sm text-gray-400 uppercase tracking-widest font-bold">Total Photos</p>
            </div>
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-lg">
                <h3 class="text-5xl font-bold text-gold mb-2">{{ $judgedCount }}</h3>
                <p class="text-sm text-gray-400 uppercase tracking-widest font-bold">Judged By You</p>
            </div>
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-lg">
                <h3 class="text-5xl font-bold text-blue-500 mb-2">{{ $pendingCount }}</h3>
                <p class="text-sm text-gray-400 uppercase tracking-widest font-bold">Remaining</p>
            </div>
        </div>

        @if($pendingCount > 0)
        <a href="{{ route('judge.next') }}" class="bg-gold hover:bg-yellow-500 text-dark font-bold py-4 px-12 rounded-xl text-lg shadow-xl hover:shadow-gold/20 transition-all transform hover:-translate-y-1" data-aos="zoom-in" data-aos-delay="200">
            START JUDGING
        </a>
        @else
        <div class="bg-green-500/10 border border-green-500/30 text-green-400 p-6 rounded-2xl max-w-2xl" data-aos="zoom-in" data-aos-delay="200">
            <i data-lucide="check-circle" class="w-12 h-12 mx-auto mb-4"></i>
            <h2 class="text-2xl font-bold mb-2">All Caught Up!</h2>
            <p>You have successfully evaluated all the photos currently available in the queue. Thank you for your hard work!</p>
        </div>
        @endif

    </div>
</x-layouts.admin>
