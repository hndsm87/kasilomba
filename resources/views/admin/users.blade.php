<x-layouts.admin title="User Management">
    <div x-data="userCrud()" class="p-8 max-w-7xl mx-auto">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between md:items-end mb-8 gap-4" data-aos="fade-down">
            <div>
                <h1 class="text-4xl font-heading text-white tracking-widest mb-2">USER MANAGEMENT</h1>
                <p class="text-gray-400">Manage administrators, verification team, and judges.</p>
            </div>
            <button @click="openModal('add')" class="px-6 py-3 bg-gold hover:bg-yellow-500 text-dark font-bold rounded-xl shadow-lg transition-colors flex items-center shrink-0">
                <i data-lucide="user-plus" class="w-5 h-5 mr-2"></i> Add User
            </button>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-500/10 border border-green-500/30 rounded-xl text-green-400 font-medium flex items-center">
                <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/30 rounded-xl text-red-400 font-medium flex items-center">
                <i data-lucide="alert-triangle" class="w-5 h-5 mr-2"></i> {{ session('error') }}
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

        <!-- Users Table -->
        <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden shadow-lg" data-aos="fade-up">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-max">
                    <thead>
                        <tr class="bg-gray-800/50 border-b border-gray-800 text-gray-400 text-xs uppercase tracking-wider">
                            <th class="py-4 px-6 font-medium">Name</th>
                            <th class="py-4 px-6 font-medium">Email</th>
                            <th class="py-4 px-6 font-medium">Role</th>
                            <th class="py-4 px-6 font-medium">Joined</th>
                            <th class="py-4 px-6 font-medium text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-800/50">
                        @foreach($users as $user)
                        <tr class="hover:bg-gray-800/30 transition-colors">
                            <td class="py-4 px-6 font-bold text-white">
                                {{ $user->name }}
                                @if($user->id === auth()->id())
                                    <span class="ml-2 px-2 py-0.5 bg-gold/20 text-gold text-[10px] rounded uppercase">You</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-gray-400">{{ $user->email }}</td>
                            <td class="py-4 px-6">
                                @foreach($user->roles as $role)
                                    @php
                                        $colorClass = match($role->name) {
                                            'Admin' => 'bg-red-500/20 text-red-400 border-red-500/30',
                                            'Admin Verifikasi' => 'bg-blue-500/20 text-blue-400 border-blue-500/30',
                                            'Judge' => 'bg-gold/20 text-gold border-gold/30',
                                            default => 'bg-gray-700 text-gray-300 border-gray-600'
                                        };
                                    @endphp
                                    <span class="px-3 py-1 border rounded text-xs uppercase tracking-wider font-bold inline-block mr-1 mb-1 {{ $colorClass }}">
                                        {{ $role->name }}
                                    </span>
                                @endforeach
                            </td>
                            <td class="py-4 px-6 text-gray-500 text-xs">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end space-x-3">
                                    <button @click="openModal('edit', {{ json_encode([
                                        'id' => $user->id,
                                        'name' => $user->name,
                                        'email' => $user->email,
                                        'role' => $user->roles->first()->name ?? ''
                                    ]) }})" class="p-2 text-gray-400 hover:text-white bg-gray-800 hover:bg-gray-700 rounded-lg transition-colors">
                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                    </button>
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-gray-400 hover:text-white bg-gray-800 hover:bg-kasi-red rounded-lg transition-colors">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    @else
                                        <button disabled class="p-2 text-gray-600 bg-gray-800/50 rounded-lg cursor-not-allowed" title="Cannot delete yourself">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add/Edit Modal -->
        <div x-show="isModalOpen" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm p-4" style="display: none;">
            <div class="bg-gray-900 border border-gray-800 rounded-2xl w-full max-w-lg shadow-2xl relative" @click.away="closeModal()">
                
                <div class="p-6 border-b border-gray-800 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-white" x-text="mode === 'add' ? 'Add New User' : 'Edit User'"></h3>
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
                            <label class="block text-sm font-medium text-gray-400 mb-2">Full Name</label>
                            <input type="text" name="name" x-model="formData.name" required class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-gold focus:border-gold placeholder-gray-500" placeholder="e.g. John Doe">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Email Address</label>
                            <input type="email" name="email" x-model="formData.email" required class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-gold focus:border-gold placeholder-gray-500" placeholder="e.g. john@example.com">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">
                                Password
                                <template x-if="mode === 'edit'">
                                    <span class="text-gray-500 font-normal ml-2">(Leave blank to keep current)</span>
                                </template>
                            </label>
                            <input type="password" name="password" :required="mode === 'add'" class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-gold focus:border-gold placeholder-gray-500" placeholder="Minimum 8 characters">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Role</label>
                            <select name="role" x-model="formData.role" required class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white focus:ring-gold focus:border-gold">
                                <option value="" disabled>Select a role...</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <p class="text-xs text-gray-500 mt-2">
                                <strong class="text-gray-400">Admin:</strong> Full access.<br>
                                <strong class="text-gray-400">Admin Verifikasi:</strong> Verifies photos, views results. Cannot edit scoring criteria or users.<br>
                                <strong class="text-gray-400">Judge:</strong> Scores photos via judging portal.
                            </p>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end space-x-3">
                        <button type="button" @click="closeModal()" class="px-5 py-2.5 bg-gray-800 text-white font-medium rounded-xl hover:bg-gray-700 transition-colors">Cancel</button>
                        <button type="submit" class="px-5 py-2.5 bg-gold hover:bg-yellow-500 text-dark font-bold rounded-xl shadow-lg transition-colors" x-text="mode === 'add' ? 'Create User' : 'Update User'"></button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('userCrud', () => ({
                isModalOpen: false,
                mode: 'add',
                formAction: '{{ route('admin.users.store') }}',
                formData: {
                    id: null,
                    name: '',
                    email: '',
                    role: ''
                },
                openModal(mode, data = null) {
                    this.mode = mode;
                    if (mode === 'edit' && data) {
                        this.formData = { ...data };
                        this.formAction = `/admin/users/${data.id}`;
                    } else {
                        this.formData = { id: null, name: '', email: '', role: '' };
                        this.formAction = '{{ route('admin.users.store') }}';
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
