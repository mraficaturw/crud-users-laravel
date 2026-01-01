<div>
    <x-modal name="profile-modal" max-width="xl">
        <!-- Header -->
        <div class="px-8 pt-8 pb-6 border-b border-default-medium">
            <div class="flex items-start justify-between">
                <div class="flex items-center gap-5">
                    <!-- Avatar -->
                    <div class="relative shrink-0">
                        @if($userAvatar)
                            <img class="w-20 h-20 rounded-full object-cover ring-4 ring-neutral-secondary-medium shadow-lg" 
                                 src="{{ asset('storage/' . $userAvatar) }}" 
                                 alt="{{ $userName }}">
                        @else
                            <div class="w-20 h-20 rounded-full bg-neutral-tertiary-medium flex items-center justify-center ring-4 ring-neutral-secondary-medium shadow-lg">
                                <svg class="w-10 h-10 text-body" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                        @endif
                        <span class="absolute bottom-1 right-1 w-5 h-5 bg-success border-3 border-white rounded-full"></span>
                    </div>
                    <!-- Name & Title -->
                    <div>
                        <h3 class="text-2xl font-bold text-heading">{{ $userName }}</h3>
                        <p class="text-body mt-1">User Profile</p>
                    </div>
                </div>
                <!-- Close Button -->
                <button type="button" 
                        wire:click="closeModal" 
                        class="p-2 rounded-lg text-body hover:text-heading hover:bg-neutral-secondary-medium transition-colors cursor-pointer">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Profile Info -->
        <div class="px-8 py-6">
            <div class="space-y-4">
                <!-- Email -->
                <div class="flex items-center gap-4 p-4 bg-neutral-secondary-medium/50 rounded-xl">
                    <div class="flex items-center justify-center w-10 h-10 bg-brand-soft rounded-lg">
                        <svg class="w-5 h-5 text-brand" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-body uppercase tracking-wider">Email Address</p>
                        <p class="text-heading font-medium">{{ $userEmail }}</p>
                    </div>
                </div>
                
                <!-- Joined Date -->
                <div class="flex items-center gap-4 p-4 bg-neutral-secondary-medium/50 rounded-xl">
                    <div class="flex items-center justify-center w-10 h-10 bg-success-soft rounded-lg">
                        <svg class="w-5 h-5 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-body uppercase tracking-wider">Member Since</p>
                        <p class="text-heading font-medium">{{ $userCreatedAt }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Actions -->
        <div class="px-8 py-5 bg-neutral-secondary-medium/50 border-t border-default-medium flex justify-end gap-3">
            <button type="button" 
                    wire:click="$dispatch('confirm-edit', { userId: {{ $userId ?? 0 }} })"
                    class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-brand rounded-lg shadow-sm hover:bg-fg-brand cursor-pointer transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                </svg>
                Edit Profile
            </button>
            <button type="button" 
                    wire:click="closeModal" 
                    class="px-5 py-2.5 text-sm font-semibold text-heading bg-white ring-1 ring-inset ring-default-medium rounded-lg shadow-sm hover:bg-neutral-secondary-medium cursor-pointer transition-colors">
                Close
            </button>
        </div>
    </x-modal>
</div>
