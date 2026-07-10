<x-layouts.admin title="Manage Criteria">
    <div class="p-8 max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-heading text-white tracking-wider">Judging Criteria</h1>
                <p class="text-gray-400 mt-1">Review the criteria and weights used by the judges.</p>
            </div>
            
            <div class="flex space-x-4">
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm transition-colors border border-gray-700 flex items-center">
                    <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i> Back to Dashboard
                </a>
            </div>
        </div>

        <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden shadow-lg">
            
            <!-- Notice -->
            <div class="bg-blue-500/10 border-b border-blue-500/20 p-4 flex items-start">
                <i data-lucide="info" class="w-5 h-5 text-blue-400 mt-0.5 mr-3 flex-shrink-0"></i>
                <div class="text-sm text-blue-200">
                    <strong class="block mb-1 text-blue-300">Criteria are Managed by System Seeders</strong>
                    In a professional judging system, criteria and weights must remain completely consistent throughout the entire competition. Allowing dynamic changes to criteria during active judging invalidates previous scores. If structural changes to the scoring system are required, please contact the System Administrator to run a new database seed.
                </div>
            </div>

            <div class="p-6">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-800 text-gray-400 text-sm uppercase tracking-wider">
                            <th class="pb-3 px-4 font-medium">Order</th>
                            <th class="pb-3 px-4 font-medium">Criteria Name</th>
                            <th class="pb-3 px-4 font-medium">Category Limit</th>
                            <th class="pb-3 px-4 font-medium text-right">Weight</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($criterias as $criteria)
                        <tr class="border-b border-gray-800/50 hover:bg-gray-800/20 transition-colors">
                            <td class="py-4 px-4 text-gray-500 font-mono">{{ $criteria->order }}</td>
                            <td class="py-4 px-4 font-bold text-white">{{ $criteria->name }}</td>
                            <td class="py-4 px-4">
                                @if($criteria->category == 'all')
                                    <span class="px-2 py-1 bg-gray-800 text-gray-300 rounded text-xs">All Categories</span>
                                @else
                                    <span class="px-2 py-1 bg-gold/10 text-gold rounded text-xs uppercase">{{ $criteria->category }}</span>
                                @endif
                            </td>
                            <td class="py-4 px-4 text-right">
                                <span class="inline-block px-3 py-1 bg-gray-800 border border-gray-700 text-white font-bold rounded-lg">{{ $criteria->weight }}%</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center text-gray-500">No criteria found in the system.</td>
                        </tr>
                        @endforelse
                    </tbody>
                    @if($criterias->sum('weight') > 0)
                    <tfoot>
                        <tr class="bg-gray-800/30">
                            <td colspan="3" class="py-4 px-4 text-right font-bold text-gray-400">Total Weight:</td>
                            <td class="py-4 px-4 text-right">
                                <span class="inline-block px-3 py-1 {{ $criterias->sum('weight') == 100 ? 'bg-green-500/20 text-green-400 border border-green-500/30' : 'bg-red-500/20 text-red-400 border border-red-500/30' }} font-bold rounded-lg">
                                    {{ $criterias->sum('weight') }}%
                                </span>
                            </td>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
        </div>

    </div>
</x-layouts.admin>
