<x-layouts.admin title="Scoring Criteria">
    <div x-data="criteriaCrud()" class="p-8 max-w-7xl mx-auto">
        
        <!-- Header -->
        <div class="flex justify-between items-end mb-8" data-aos="fade-down">
            <div>
                <h1 class="text-4xl font-heading text-white tracking-widest mb-2">SCORING CRITERIA</h1>
                <p class="text-gray-400">Manage the metrics and weights used by judges to evaluate submissions.</p>
            </div>
            <button @click="openModal('add')" class="px-6 py-3 bg-gold hover:bg-yellow-500 text-dark font-bold rounded-xl shadow-lg transition-colors flex items-center">
                <i data-lucide="plus" class="w-5 h-5 mr-2"></i> Add Criteria
            </button>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-500/10 border border-green-500/30 rounded-xl text-green-400 font-medium">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/30 rounded-xl text-red-400 font-medium">
                {{ session('error') }}
            </div>
        @endif
        @if($errors->any())
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/30 rounded-xl text-red-400 font-medium">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Criteria Table -->
        <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden shadow-lg" data-aos="fade-up">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-800/50 border-b border-gray-800 text-gray-400 text-xs uppercase tracking-wider">
                        <th class="py-4 px-6 font-medium">Order</th>
                        <th class="py-4 px-6 font-medium">Name</th>
                        <th class="py-4 px-6 font-medium">Category</th>
                        <th class="py-4 px-6 font-medium text-center">Weight (%)</th>
                        <th class="py-4 px-6 font-medium text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-800/50">
                    @forelse($criterias as $c)
                    <tr class="hover:bg-gray-800/30 transition-colors">
                        <td class="py-4 px-6 font-bold text-gray-500">{{ $c->order }}</td>
                        <td class="py-4 px-6 font-bold text-white">{{ $c->name }}</td>
                        <td class="py-4 px-6">
                            <span class="px-3 py-1 bg-gray-800 border border-gray-700 text-gray-300 rounded text-xs uppercase tracking-wider font-bold">
                                {{ $c->category }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="text-gold font-bold text-lg">{{ $c->weight }}%</span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <div class="flex items-center justify-end space-x-3">
                                <button @click="openModal('edit', {{ json_encode($c) }})" class="p-2 text-gray-400 hover:text-white bg-gray-800 hover:bg-gray-700 rounded-lg transition-colors">
                                    <i data-lucide="edit" class="w-4 h-4"></i>
                                </button>
                                <form action="{{ route('admin.criteria.destroy', $c->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this criteria?');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-white bg-gray-800 hover:bg-kasi-red rounded-lg transition-colors">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center text-gray-500">
                            No criteria defined yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Add/Edit Modal -->
        <div x-show="isModalOpen" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm p-4" style="display: none;">
            <div class="bg-gray-900 border border-gray-800 rounded-2xl w-full max-w-lg shadow-2xl relative" @click.away="closeModal()">
                
                <div class="p-6 border-b border-gray-800 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-white" x-text="mode === 'add' ? 'Add New Criteria' : 'Edit Criteria'"></h3>
                    <button @click="closeModal()" class="text-gray-400 hover:text-white transition-colors">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>

                <form :action="formAction" method="POST" class="p-6">
                    @csrf
                    <template x-if="mode === 'edit'">
                        <input type="hidden" name="_method" value="PUT">
                    </template>

                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Criteria Name</label>
                            <input type="text" name="name" x-model="formData.name" required class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-gold focus:border-gold">
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">Target Category</label>
                                <select name="category" x-model="formData.category" required class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-gold focus:border-gold">
                                    <option value="all">All Categories</option>
                                    <option value="smartphone">Smartphone Only</option>
                                    <option value="dslr">DSLR Only</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">Weight (%)</label>
                                <input type="number" name="weight" x-model="formData.weight" min="1" max="100" required class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-gold focus:border-gold">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Display Order</label>
                            <input type="number" name="order" x-model="formData.order" min="1" required class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-gold focus:border-gold">
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end space-x-3">
                        <button type="button" @click="closeModal()" class="px-5 py-2.5 bg-gray-800 text-white font-medium rounded-xl hover:bg-gray-700 transition-colors">Cancel</button>
                        <button type="submit" class="px-5 py-2.5 bg-gold hover:bg-yellow-500 text-dark font-bold rounded-xl shadow-lg transition-colors" x-text="mode === 'add' ? 'Save Criteria' : 'Update Criteria'"></button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('criteriaCrud', () => ({
                isModalOpen: false,
                mode: 'add',
                formAction: '{{ route('admin.criteria.store') }}',
                formData: {
                    id: null,
                    name: '',
                    category: 'all',
                    weight: 10,
                    order: 1
                },
                openModal(mode, data = null) {
                    this.mode = mode;
                    if (mode === 'edit' && data) {
                        this.formData = { ...data };
                        this.formAction = `/admin/criteria/${data.id}`;
                    } else {
                        this.formData = { id: null, name: '', category: 'all', weight: 10, order: 1 };
                        this.formAction = '{{ route('admin.criteria.store') }}';
                    }
                    this.isModalOpen = true;
                },
                closeModal() {
                    this.isModalOpen = false;
                }
            }));
        });
    </script>
    @endpush
</x-layouts.admin>
