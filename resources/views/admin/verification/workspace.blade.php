<x-layouts.admin title="Verification Workspace | {{ $photo->participant_name ?? 'Unknown' }}">
    <div x-data="verificationWorkspace()" class="flex flex-col h-[calc(100dvh-66px)] md:h-full bg-dark text-white overflow-hidden relative">
        
        <!-- Top Bar -->
        <div class="flex-shrink-0 bg-gray-900 border-b border-gray-800 px-6 py-4 flex justify-between items-center z-40 relative">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.submissions.index') }}" class="p-2 hover:bg-gray-800 rounded-lg text-gray-400 hover:text-white transition-colors" title="Back to Queue">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i>
                </a>
                <div>
                    <h2 class="text-xl font-bold">{{ $photo->participant_name ?? 'Unknown Participant' }}</h2>
                    <p class="text-xs text-gray-500 uppercase tracking-widest mt-0.5">{{ $photo->category }} • {{ $photo->village ?? 'Unknown Village' }}</p>
                </div>
            </div>

            <!-- Tabs Navigation -->
            <div class="flex bg-gray-800 p-1 rounded-xl overflow-x-auto max-w-[55%] md:max-w-none scrollbar-none">
                <button @click="tab = 'identity'" :class="{ 'bg-gray-700 text-white shadow-sm': tab === 'identity', 'text-gray-400 hover:text-gray-200': tab !== 'identity' }" class="px-3 md:px-6 py-2 rounded-lg text-xs md:text-sm font-medium transition-all whitespace-nowrap">Identity</button>
                <button @click="tab = 'photo'" :class="{ 'bg-gray-700 text-white shadow-sm': tab === 'photo', 'text-gray-400 hover:text-gray-200': tab !== 'photo' }" class="px-3 md:px-6 py-2 rounded-lg text-xs md:text-sm font-medium transition-all whitespace-nowrap">Photo</button>
                <button @click="tab = 'story'" :class="{ 'bg-gray-700 text-white shadow-sm': tab === 'story', 'text-gray-400 hover:text-gray-200': tab !== 'story' }" class="px-3 md:px-6 py-2 rounded-lg text-xs md:text-sm font-medium transition-all whitespace-nowrap">Story</button>
                <button @click="tab = 'checklist'" :class="{ 'bg-gray-700 text-white shadow-sm': tab === 'checklist', 'text-gray-400 hover:text-gold': tab !== 'checklist' }" class="md:hidden px-3 py-2 rounded-lg text-xs font-bold transition-all whitespace-nowrap text-gold border border-gold/20">Checklist</button>
            </div>

            <!-- Health Score -->
            <div class="flex items-center space-x-3">
                <div class="text-right">
                    <div class="text-xs text-gray-400 uppercase tracking-wider">Health Score</div>
                    @php
                        $health = $photo->health_score;
                        $healthColor = $health >= 90 ? 'text-green-400' : ($health >= 70 ? 'text-yellow-400' : 'text-red-400');
                        $healthText = $health >= 90 ? 'Excellent' : ($health >= 70 ? 'Needs Review' : 'High Risk');
                    @endphp
                    <div class="font-bold {{ $healthColor }}">{{ $health }}% <span class="text-gray-500 text-xs ml-1 font-normal">({{ $healthText }})</span></div>
                </div>
            </div>
        </div>

        <!-- Disqualified Banner -->
        @if($photo->is_disqualified)
            @php
                $notesStr = $photo->verification_notes ?? '';
                preg_match('/Reason: (.*?)\n/', $notesStr, $matches);
                $reason = $matches[1] ?? 'Unknown Reason';
                $notes = trim(preg_replace('/Reason: .*?\nNotes:/', '', $notesStr));
            @endphp
            <div class="bg-red-900 border-b border-red-500/50 p-4 px-6 z-30 relative shadow-lg">
                <div class="flex items-start max-w-7xl">
                    <i data-lucide="x-octagon" class="w-6 h-6 text-red-400 mr-4 flex-shrink-0 mt-0.5"></i>
                    <div>
                        <h3 class="text-white font-bold text-base mb-1">Peserta Ini Telah Didiskualifikasi</h3>
                        <p class="text-red-200 text-sm leading-relaxed">
                            <strong class="text-white">Alasan:</strong> {{ $reason }}<br>
                            <strong class="text-white">Catatan Tambahan:</strong> {{ $notes ?: '-' }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Workspace Area -->
        <div class="flex-grow flex flex-col md:flex-row overflow-hidden">
            
            <!-- Left Side: Dynamic Tab Content -->
            <div x-show="!isMobile || tab !== 'checklist'" class="flex-grow flex flex-col h-full bg-black relative">
                
                <!-- TAB: IDENTITY & AGREEMENTS -->
                <div x-show="tab === 'identity'" class="absolute inset-0 flex flex-col md:flex-row" style="display: none;" x-transition.opacity>
                    <!-- Agreements Viewer -->
                    <div class="w-full md:w-2/3 h-1/2 md:h-full bg-black relative flex flex-col p-6 md:p-12 overflow-y-auto pb-20 md:pb-28">
                        <div class="max-w-2xl mx-auto w-full">
                            <h3 class="text-2xl font-heading font-bold text-white mb-2">Participant Agreements</h3>
                            <p class="text-gray-400 mb-8">The participant has checked the following disclaimers during submission.</p>
                            
                            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 space-y-4">
                                @php
                                    $agreements = $photo->agreements ? json_decode($photo->agreements, true) : [];
                                    $terms = [
                                        'warga_paser' => 'Saya adalah warga Kabupaten Paser.',
                                        'karya_sendiri' => 'Foto merupakan karya saya sendiri.',
                                        'tahun_2026' => 'Foto diambil pada tahun 2026.',
                                        'belum_juara' => 'Foto belum pernah menjadi juara pada perlombaan fotografi.',
                                        'satu_kategori' => 'Saya hanya mengikuti satu kategori.',
                                        'satu_karya' => 'Saya hanya mengirim satu karya.',
                                        'izin_subjek' => 'Saya telah memperoleh izin dari subjek foto.',
                                        'hak_publikasi' => 'Hak publikasi diberikan kepada panitia lomba.',
                                        'setuju_syarat' => 'Setuju dengan seluruh syarat dan ketentuan (Siap didiskualifikasi).'
                                    ];
                                @endphp

                                @if(!empty($agreements))
                                    @foreach($terms as $key => $label)
                                        <div class="flex items-start space-x-3">
                                            @if(isset($agreements[$key]) && $agreements[$key])
                                                <i data-lucide="check-circle-2" class="w-6 h-6 text-green-500 flex-shrink-0"></i>
                                                <span class="text-gray-200">{{ $label }}</span>
                                            @else
                                                <i data-lucide="x-circle" class="w-6 h-6 text-gray-600 flex-shrink-0"></i>
                                                <span class="text-gray-500 line-through">{{ $label }}</span>
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-gray-500 text-center py-4">No agreements recorded for this submission.</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Participant Details -->
                    <div class="w-full md:w-1/3 h-1/2 md:h-full bg-gray-900 border-t md:border-t-0 md:border-l border-gray-800 overflow-y-auto p-6 pb-20 md:pb-28">
                        <h3 class="text-lg font-bold mb-6 text-white border-b border-gray-800 pb-4">Participant Data</h3>
                        
                        @if($photo->is_duplicate)
                        <div class="mb-6 p-4 bg-red-900/30 border border-red-500/30 rounded-xl">
                            <div class="flex items-center text-red-400 font-bold mb-2">
                                <i data-lucide="alert-triangle" class="w-5 h-5 mr-2"></i> Duplicate Detected
                            </div>
                            <p class="text-xs text-gray-400 mb-3 leading-relaxed">This participant has submitted multiple photos, potentially violating the rule of one submission per category.</p>
                            <div class="space-y-2 border-t border-red-900/50 pt-3 mt-3">
                                <span class="text-xs text-red-300 font-semibold uppercase tracking-wider block mb-1">Other Submissions:</span>
                                @foreach($photo->duplicatePhotos()->get() as $dup)
                                    <a href="{{ route('admin.submissions.show', $dup->id) }}" target="_blank" class="text-sm font-medium text-blue-400 hover:text-blue-300 hover:underline flex items-center bg-gray-900/50 px-3 py-2 rounded-lg border border-gray-800">
                                        <i data-lucide="external-link" class="w-4 h-4 mr-2 flex-shrink-0"></i> 
                                        <span class="truncate">{{ $dup->title }}</span>
                                        <span class="ml-2 text-[10px] px-1.5 py-0.5 bg-gray-800 text-gray-400 rounded uppercase tracking-wider">{{ $dup->category }}</span>
                                        @if($dup->is_disqualified)
                                            <span class="ml-2 text-[10px] px-1.5 py-0.5 bg-red-900/50 text-red-400 border border-red-500/50 rounded uppercase tracking-wider">Disqualified</span>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        
                        <div class="space-y-5">
                            <x-verification-field label="Full Name" value="{{ $photo->participant_name }}" />
                            <x-verification-field label="Address" value="{{ $photo->address }}" />
                            <x-verification-field label="Village" value="{{ $photo->village }}" />
                            <x-verification-field label="District" value="{{ $photo->district }}" />
                            
                            <div class="pt-4 border-t border-gray-800">
                                <h4 class="text-xs uppercase tracking-wider text-gray-500 font-bold mb-4">Contact Info</h4>
                                <x-verification-field label="WhatsApp" value="{{ $photo->whatsapp }}" />
                                <x-verification-field label="Instagram" value="{{ $photo->instagram }}" />
                            </div>
                            
                            <div class="pt-6 mt-6 border-t border-gray-800">
                                <button @click="markChecked('identity')" 
                                        :class="checks.identity ? 'bg-green-900/40 text-green-400 border-green-500/50' : 'bg-gray-800 text-white hover:bg-gray-700 border-gray-700'" 
                                        class="w-full py-3 px-4 rounded-xl font-bold border transition-colors flex items-center justify-center">
                                    <i data-lucide="check-circle-2" class="w-5 h-5 mr-2" :class="{'text-green-500': checks.identity}"></i>
                                    <span x-text="checks.identity ? 'Identity Terverifikasi' : 'Tandai Identity Telah Dicek'"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB: PHOTO -->
                <div x-show="tab === 'photo'" class="absolute inset-0 flex flex-col md:flex-row" x-transition.opacity>
                    <!-- Main Photo Viewer -->
                    <div class="w-full md:w-2/3 h-1/2 md:h-full bg-black relative flex items-center justify-center p-4 md:p-8 group">
                        <img src="{{ $photo->medium_url ?? $photo->google_drive_preview }}" referrerpolicy="no-referrer" alt="Competition Photo" class="max-w-full max-h-full object-contain transition-transform duration-300" :class="{ 'scale-150 cursor-move': zoomPhoto }">
                        
                        <!-- Toolbar overlay -->
                        <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <button @click="zoomPhoto = !zoomPhoto" class="p-3 bg-gray-900/80 hover:bg-gold text-white hover:text-dark rounded-full backdrop-blur-md transition-colors" title="Zoom">
                                <i data-lucide="zoom-in" class="w-5 h-5"></i>
                            </button>
                            <button @click="isFullscreen = true" class="p-3 bg-gray-900/80 hover:bg-gold text-white hover:text-dark rounded-full backdrop-blur-md transition-colors" title="Fullscreen (F)">
                                <i data-lucide="maximize" class="w-5 h-5"></i>
                            </button>
                            <a href="{{ $photo->original_url ?? $photo->google_drive_link }}" target="_blank" class="p-3 bg-gray-900/80 hover:bg-gold text-white hover:text-dark rounded-full backdrop-blur-md transition-colors" title="Download Original">
                                <i data-lucide="download" class="w-5 h-5"></i>
                            </a>
                        </div>
                    </div>
                    
                    <!-- EXIF Details -->
                    <div class="w-full md:w-1/3 h-1/2 md:h-full bg-gray-900 border-t md:border-t-0 md:border-l border-gray-800 overflow-y-auto p-6 pb-20 md:pb-28">
                        <h3 class="text-lg font-bold mb-6 text-white border-b border-gray-800 pb-4">EXIF Metadata</h3>
                        
                        @if($photo->exif_data)
                            <!-- Will implement EXIF UI later if needed -->
                            <pre class="text-xs text-gray-400 bg-gray-800 p-4 rounded-xl overflow-x-auto">{{ json_encode($photo->exif_data, JSON_PRETTY_PRINT) }}</pre>
                        @else
                            <div class="bg-gray-800/50 border border-gray-700 rounded-xl p-6 text-center">
                                <i data-lucide="camera-off" class="w-10 h-10 mx-auto text-gray-500 mb-3"></i>
                                <h4 class="text-gray-300 font-medium">No EXIF Metadata Found</h4>
                                <p class="text-xs text-gray-500 mt-2">The uploaded file does not contain readable camera settings.</p>
                            </div>
                        @endif

                        <div class="mt-8 pt-6 border-t border-gray-800 space-y-4">
                            <x-verification-field label="Taken At" value="{{ $photo->taken_at ? $photo->taken_at->format('d M Y') : 'Unknown' }}" />
                            <x-verification-field label="Submission Date" value="{{ $photo->created_at->format('d M Y, H:i') }}" />
                        </div>
                        
                        <div class="pt-6 mt-6 border-t border-gray-800">
                            <button @click="markChecked('photo')" 
                                    :class="checks.photo ? 'bg-green-900/40 text-green-400 border-green-500/50' : 'bg-gray-800 text-white hover:bg-gray-700 border-gray-700'" 
                                    class="w-full py-3 px-4 rounded-xl font-bold border transition-colors flex items-center justify-center">
                                <i data-lucide="check-circle-2" class="w-5 h-5 mr-2" :class="{'text-green-500': checks.photo}"></i>
                                <span x-text="checks.photo ? 'Photo Terverifikasi' : 'Tandai Photo Telah Dicek'"></span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- TAB: STORY -->
                <div x-show="tab === 'story'" class="absolute inset-0 flex" style="display: none;" x-transition.opacity>
                    <div class="w-full h-full bg-gray-900 overflow-y-auto p-6 md:p-12 pb-20 md:pb-28">
                        <div class="max-w-3xl mx-auto">
                            <div class="mb-4 inline-block px-3 py-1 bg-gray-800 border border-gray-700 text-gray-300 rounded text-xs uppercase tracking-wider font-bold">
                                {{ $photo->category }}
                            </div>
                            <h1 class="text-4xl font-heading font-bold text-white mb-6 leading-tight">{{ $photo->title }}</h1>
                            <div class="flex items-center text-sm text-gray-400 mb-10 space-x-4 border-b border-gray-800 pb-6 flex-wrap gap-y-2">
                                <div class="flex items-center"><i data-lucide="map-pin" class="w-4 h-4 mr-2"></i> {{ $photo->location ?? 'Unknown Location' }}</div>
                                <div class="flex items-center"><i data-lucide="calendar" class="w-4 h-4 mr-2"></i> {{ $photo->taken_at ? $photo->taken_at->format('d M Y') : 'Unknown Date' }}</div>
                                @if($photo->device_used)
                                    <div class="flex items-center"><i data-lucide="camera" class="w-4 h-4 mr-2"></i> {{ $photo->device_used }}</div>
                                @endif
                            </div>
                            
                            <div class="prose prose-invert prose-lg max-w-none text-gray-300 leading-relaxed whitespace-pre-wrap">{{ $photo->story }}</div>
                            
                            <div class="pt-8 mt-12 border-t border-gray-800 flex justify-end">
                                <button @click="markChecked('story')" 
                                        :class="checks.story ? 'bg-green-900/40 text-green-400 border-green-500/50' : 'bg-gray-800 text-white hover:bg-gray-700 border-gray-700'" 
                                        class="py-3 px-6 rounded-xl font-bold border transition-colors flex items-center justify-center shadow-lg">
                                    <i data-lucide="check-circle-2" class="w-5 h-5 mr-2" :class="{'text-green-500': checks.story}"></i>
                                    <span x-text="checks.story ? 'Story Terverifikasi' : 'Tandai Story Telah Dicek'"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
            <!-- Right Side: Checklist Panel -->
            <div x-show="!isMobile || tab === 'checklist'" class="w-full md:w-80 flex-shrink-0 bg-gray-900 border-t md:border-t-0 md:border-l border-gray-800 flex flex-col h-full z-30">
                <div class="p-5 border-b border-gray-800">
                    <h3 class="font-bold text-white uppercase tracking-wider text-sm flex items-center">
                        <i data-lucide="check-square" class="w-4 h-4 mr-2 text-gold"></i> Verification Checklist
                    </h3>
                </div>
                
                <div class="flex-grow overflow-y-auto p-5 space-y-3 pb-28">
                    <!-- Automated Checks -->
                    @php
                        $agreements = $photo->agreements ? json_decode($photo->agreements, true) : [];
                        $allAgreed = count(array_filter($agreements)) === 9; // 9 total checkboxes
                    @endphp
                    
                    <x-checklist-item label="All Terms Agreed" :passed="$allAgreed" />
                    <x-checklist-item label="Village & District" :passed="!empty($photo->district) && !empty($photo->village)" />
                    <x-checklist-item label="Photo Uploaded" :passed="!empty($photo->google_drive_link)" />
                    <x-checklist-item label="EXIF Detected" :passed="!empty($photo->exif_data)" />
                    <x-checklist-item label="Photo Title" :passed="!empty($photo->title) && $photo->title !== 'Untitled Photo'" />
                    <x-checklist-item label="Story Completed" :passed="!empty($photo->story) && strlen($photo->story) > 50" />
                    <x-checklist-item label="Instagram Provided" :passed="!empty($photo->instagram)" />
                    
                    <div class="mt-8 mb-4 border-t border-gray-800 pt-6">
                        <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">Manual Review</h4>
                    </div>
                    
                    <!-- Manual Checks (Interactive) -->
                    <label class="flex items-start space-x-3 cursor-pointer group">
                        <input type="checkbox" class="mt-1 w-4 h-4 rounded border-gray-700 text-gold focus:ring-gold bg-gray-800">
                        <span class="text-sm text-gray-300 group-hover:text-white transition-colors">Theme matches competition</span>
                    </label>
                    <label class="flex items-start space-x-3 cursor-pointer group">
                        <input type="checkbox" class="mt-1 w-4 h-4 rounded border-gray-700 text-gold focus:ring-gold bg-gray-800">
                        <span class="text-sm text-gray-300 group-hover:text-white transition-colors">No obvious AI generation</span>
                    </label>
                </div>
            </div>

        </div>

        <!-- Floating Bottom Action Bar -->
        <div class="absolute bottom-0 left-0 right-80 bg-gray-900 border-t border-gray-800 p-4 px-6 flex justify-between items-center z-40 backdrop-blur-md bg-opacity-90">
            <div class="flex items-center space-x-2 text-xs text-gray-500 font-medium tracking-wider">
                <span class="px-2 py-1 bg-gray-800 rounded">A</span> Approve
                <span class="px-2 py-1 bg-gray-800 rounded ml-2">R</span> Reject
                <span class="px-2 py-1 bg-gray-800 rounded ml-2">F</span> Fullscreen
            </div>

            <div class="flex space-x-3">
                <button @click="showReject = true" class="px-6 py-2.5 bg-gray-800 hover:bg-kasi-red hover:text-white text-gray-300 font-bold rounded-xl transition-colors flex items-center border border-gray-700">
                    <i data-lucide="x" class="w-4 h-4 mr-2"></i> Reject
                </button>
                <form action="{{ route('admin.submissions.approve', $photo->id) }}" method="POST" class="relative group">
                    @csrf
                    <button type="submit" 
                            :disabled="!canApprove" 
                            :class="canApprove ? 'bg-green-600 hover:bg-green-500 text-white shadow-lg shadow-green-900/50' : 'bg-gray-800 text-gray-600 cursor-not-allowed border border-gray-700'" 
                            class="px-6 py-2.5 font-bold rounded-xl transition-all duration-300 flex items-center">
                        <i data-lucide="check" class="w-4 h-4 mr-2"></i> Approve Submission
                    </button>
                    <!-- Tooltip Hint -->
                    <div x-show="!canApprove" class="absolute bottom-full right-0 mb-3 w-56 bg-gray-800 text-gray-300 text-xs rounded-xl p-3 border border-gray-700 text-center shadow-2xl opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50">
                        <div class="font-bold text-white mb-1">Tombol Terkunci</div>
                        Silakan buka ketiga tab (Identity, Photo, Story) dan klik tombol Verifikasi di masing-masing tab.
                        <!-- Arrow pointer -->
                        <div class="absolute -bottom-2 right-12 w-4 h-4 bg-gray-800 border-b border-r border-gray-700 transform rotate-45"></div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Reject Modal -->
        <div x-show="showReject" class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm" style="display: none;" x-transition>
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-8 max-w-md w-full shadow-2xl relative" @click.away="showReject = false">
                <h3 class="text-xl font-bold text-white mb-2">Reject Submission</h3>
                <p class="text-sm text-gray-400 mb-6">This will disqualify the participant from the competition. Please provide a reason.</p>
                
                <form action="{{ route('admin.submissions.reject', $photo->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-400 mb-2">Reason</label>
                        <select name="reason" required class="w-full bg-gray-800 border border-gray-700 rounded-xl text-white px-4 py-2.5 focus:ring-kasi-red focus:border-kasi-red">
                            <option value="">Select a reason...</option>
                            <option value="Wrong Category">Wrong Category</option>
                            <option value="Outside Kabupaten Paser">Outside Kabupaten Paser</option>
                            <option value="Invalid Identity">Invalid Identity</option>
                            <option value="AI Generated">AI Generated</option>
                            <option value="Heavy Manipulation">Heavy Manipulation</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-400 mb-2">Additional Notes</label>
                        <textarea name="notes" required rows="3" class="w-full bg-gray-800 border border-gray-700 rounded-xl text-white px-4 py-3 focus:ring-kasi-red focus:border-kasi-red" placeholder="Provide details..."></textarea>
                    </div>
                    
                    <div class="flex space-x-3 justify-end">
                        <button type="button" @click="showReject = false" class="px-5 py-2.5 bg-gray-800 text-gray-300 hover:text-white font-medium rounded-xl transition-colors">Cancel</button>
                        <button type="submit" class="px-5 py-2.5 bg-kasi-red hover:bg-red-500 text-white font-bold rounded-xl transition-colors shadow-lg shadow-red-900/50">Confirm Rejection</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Fullscreen Image Modal -->
        <div x-show="isFullscreen" class="fixed inset-0 z-[100] bg-black flex items-center justify-center" style="display: none;" x-transition>
            <button @click="isFullscreen = false" class="absolute top-6 right-6 p-3 bg-gray-900/50 hover:bg-gold text-white hover:text-dark rounded-full transition-colors z-50">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
            <img src="{{ $photo->original_url ?? $photo->google_drive_preview }}" referrerpolicy="no-referrer" alt="Fullscreen Photo" class="max-w-screen max-h-screen object-contain">
        </div>

        <!-- Keyboard Shortcuts Listener -->
        <div @keydown.window="handleKeydown($event)"></div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('verificationWorkspace', () => ({
                tab: 'photo', // identity, photo, story
                zoomCard: false,
                zoomPhoto: false,
                isFullscreen: false,
                showReject: false,
                isMobile: window.innerWidth < 768,
                
                checks: {
                    photo: false,
                    identity: false,
                    story: false
                },
                
                init() {
                    window.addEventListener('resize', () => {
                        this.isMobile = window.innerWidth < 768;
                    });
                },
                
                get canApprove() {
                    return this.checks.photo && this.checks.identity && this.checks.story;
                },

                markChecked(tabName) {
                    this.checks[tabName] = true;
                    // Auto advance to next unverified tab
                    if (tabName === 'photo' && !this.checks.identity) this.tab = 'identity';
                    else if (tabName === 'identity' && !this.checks.story) this.tab = 'story';
                    else if (tabName === 'story' && !this.checks.photo) this.tab = 'photo';
                    
                    // Auto open checklist tab on mobile when all checks are completed
                    if (this.canApprove && this.isMobile) {
                        this.tab = 'checklist';
                    }
                },
                
                handleKeydown(e) {
                    // Don't trigger if typing in an input/textarea
                    if (['INPUT', 'TEXTAREA', 'SELECT'].includes(e.target.tagName)) return;
                    
                    if (e.key === 'a' || e.key === 'A') {
                        // Approve form submit
                        if(this.canApprove) {
                            const approveBtn = document.querySelector('form[action*="approve"] button');
                            if(approveBtn && !this.showReject) approveBtn.click();
                        }
                    }
                    if (e.key === 'r' || e.key === 'R') {
                        // Open reject modal
                        this.showReject = true;
                    }
                    if (e.key === 'f' || e.key === 'F') {
                        // Toggle fullscreen
                        this.isFullscreen = !this.isFullscreen;
                    }
                    if (e.key === 'Escape') {
                        // Close modals
                        this.showReject = false;
                        this.isFullscreen = false;
                    }
                    if (e.key === '1') this.tab = 'identity';
                    if (e.key === '2') this.tab = 'photo';
                    if (e.key === '3') this.tab = 'story';
                }
            }));
        });
    </script>
    @endpush
</x-layouts.admin>
