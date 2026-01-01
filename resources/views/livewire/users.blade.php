<div class="max-w-4xl mx-auto my-14 px-4 sm:px-6 lg:px-8"
     x-data="{
         selectedUsers: @entangle('selectedUsers'),
         selectAll: false,
         get userIds() {
             return Array.from(document.querySelectorAll('[data-user-id]')).map(el => el.dataset.userId);
         },
         toggleSelectAll() {
             if (this.selectAll) {
                 this.selectedUsers = [...this.userIds];
             } else {
                 this.selectedUsers = [];
             }
         },
         isSelected(id) {
             return this.selectedUsers.includes(String(id));
         },
         toggleUser(id) {
             const strId = String(id);
             if (this.selectedUsers.includes(strId)) {
                 this.selectedUsers = this.selectedUsers.filter(u => u !== strId);
             } else {
                 this.selectedUsers = [...this.selectedUsers, strId];
             }
             this.updateSelectAllState();
         },
         updateSelectAllState() {
             this.selectAll = this.userIds.length > 0 && this.selectedUsers.length === this.userIds.length;
         }
     }"
     x-init="$watch('selectedUsers', () => updateSelectAllState())"
     wire:key="users-table-{{ $users->currentPage() }}">
    <div class="relative overflow-hidden bg-neutral-primary-soft shadow-xl rounded-2xl border border-default-medium">
        
        <!-- Header / Toolbar -->
        <div class="flex flex-col md:flex-row items-center justify-between gap-4 p-5 bg-neutral-primary-soft border-b border-default-medium">
            
            <!-- Action Dropdown with Alpine.js -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" 
                        @click.away="open = false" 
                        class="inline-flex items-center justify-center text-heading bg-white border border-default-medium hover:bg-neutral-secondary-medium hover:text-brand focus:ring-4 focus:ring-brand-soft shadow-sm font-medium rounded-lg text-sm px-4 py-2.5 transition-all duration-200 focus:outline-none select-none cursor-pointer">
                    <span>Actions</span>
                    <template x-if="selectedUsers.length > 0">
                        <span class="ml-2 px-2 py-0.5 text-xs font-semibold bg-brand text-white rounded-full" x-text="selectedUsers.length"></span>
                    </template>
                    <svg class="w-4 h-4 ms-2 transition-transform duration-200" :class="open ? 'rotate-180' : ''" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7"/></svg>
                </button>
                
                <!-- Dropdown menu -->
                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="absolute z-50 left-0 mt-2 w-52 bg-white border border-default-medium rounded-xl shadow-xl overflow-hidden origin-top-left" 
                     style="display: none;">
                    <ul class="py-1 text-sm text-body">
                        <li><a href="#" class="block px-4 py-2.5 hover:bg-brand-soft hover:text-brand transition-colors">Reward User</a></li>
                        <li><a href="#" class="block px-4 py-2.5 hover:bg-brand-soft hover:text-brand transition-colors">Promote Role</a></li>
                        <li><a href="#" class="block px-4 py-2.5 hover:bg-brand-soft hover:text-brand transition-colors">Archive Data</a></li>
                        <div class="h-px bg-default-medium my-1"></div>
                        <li>
                            <button wire:click="confirmBulkDelete" 
                                    :class="selectedUsers.length > 0 ? 'text-danger hover:bg-danger-soft hover:text-fg-danger-strong cursor-pointer' : 'text-body/50 cursor-not-allowed'"
                                    :disabled="selectedUsers.length === 0"
                                    class="block w-full text-left px-4 py-2.5 transition-colors">
                                Delete Selected
                                <template x-if="selectedUsers.length > 0">
                                    <span class="ml-1 text-xs" x-text="'(' + selectedUsers.length + ')'"></span>
                                </template>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Search Input -->
            <div class="relative w-full md:w-auto">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/></svg>
                </div>
                <input type="text" 
                       wire:model.live.debounce.100ms="search" 
                       placeholder="Search users..." 
                       class="block w-full md:w-80 ps-10 pe-4 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-lg focus:ring-2 focus:ring-brand focus:border-brand shadow-sm placeholder:text-body transition-all duration-200">
                
                <!-- Clear search button -->
                @if($search)
                    <button wire:click="$set('search', '')" 
                            class="absolute inset-y-0 end-0 flex items-center pe-3 text-body hover:text-heading transition-colors cursor-pointer">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                @endif
            </div>
        </div>

        <!-- Table Container with Fixed Height -->
        <div class="overflow-x-auto min-h-[500px] max-h-[600px] scrollbar-hidden relative">
            <table class="w-full text-sm text-left text-body table-fixed">
                <thead class="text-xs text-body uppercase bg-neutral-secondary-medium border-b border-default-medium sticky top-0 z-10 shadow-sm">
                    <tr>
                        <!-- Select All Checkbox -->
                        <th scope="col" class="p-4 w-14 bg-neutral-secondary-medium">
                            <div class="flex items-center">
                                <input type="checkbox" 
                                       x-model="selectAll"
                                       @change="toggleSelectAll()"
                                       class="w-4 h-4 text-brand bg-white border-default-medium rounded focus:ring-brand-soft focus:ring-2 cursor-pointer">
                                <label class="sr-only">Select all</label>
                            </div>
                        </th>

                        <!-- Sortable User Column -->
                        <th scope="col" class="w-auto bg-neutral-secondary-medium">
                            <button type="button" wire:click="setSorting('name')" 
                                    class="w-full px-6 py-4 font-semibold tracking-wider cursor-pointer hover:bg-neutral-tertiary-medium transition-colors select-none text-left flex items-center gap-2">
                                <span>User</span>
                                @if($sortBy === 'name')
                                    <svg class="w-4 h-4 text-brand transition-transform duration-200 {{ $sortDirection === 'asc' ? '' : 'rotate-180' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-body/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 9l4-4 4 4m0 6l-4 4-4-4"/>
                                    </svg>
                                @endif
                            </button>
                        </th>

                        <!-- Sortable Created At Column -->
                        <th scope="col" class="hidden md:table-cell w-40 bg-neutral-secondary-medium">
                            <button type="button" wire:click="setSorting('created_at')" 
                                    class="w-full px-4 py-4 font-semibold tracking-wider cursor-pointer hover:bg-neutral-tertiary-medium transition-colors select-none text-left flex items-center gap-2">
                                <span>Created</span>
                                @if($sortBy === 'created_at')
                                    <svg class="w-4 h-4 text-brand transition-transform duration-200 {{ $sortDirection === 'asc' ? '' : 'rotate-180' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-body/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 9l4-4 4 4m0 6l-4 4-4-4"/>
                                    </svg>
                                @endif
                            </button>
                        </th>

                        <!-- Action Column -->
                        <th scope="col" class="px-6 py-4 font-semibold tracking-wider text-right bg-neutral-secondary-medium w-36">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-default-medium">
                @forelse ($users as $user)
                    <tr class="bg-white hover:bg-neutral-secondary-medium/60 transition-colors duration-200 group"
                        :class="isSelected({{ $user->id }}) ? '!bg-brand-soft/40' : ''"
                        data-user-id="{{ $user->id }}">
                        <!-- Row Checkbox -->
                        <td class="w-14 p-4">
                            <div class="flex items-center">
                                <input type="checkbox" 
                                       :checked="isSelected({{ $user->id }})"
                                       @change="toggleUser({{ $user->id }})"
                                       class="w-4 h-4 text-brand bg-white border-default-medium rounded focus:ring-brand-soft focus:ring-2 cursor-pointer">
                                <label class="sr-only">Select user {{ $user->name }}</label>
                            </div>
                        </td>

                        <!-- User Info (Clickable to view profile) -->
                        <td class="px-6 py-4 cursor-pointer" wire:click="$dispatch('view-profile', { userId: {{ $user->id }} })">
                            <div class="flex items-center">
                                <div class="relative shrink-0">
                                    @if($user->avatar)
                                        <img class="w-12 h-12 rounded-full object-cover ring-2 ring-white shadow-sm" src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}">
                                    @else
                                        <div class="w-12 h-12 rounded-full bg-neutral-tertiary-medium flex items-center justify-center ring-2 ring-white text-body shadow-sm">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                        </div>
                                    @endif
                                    <span class="absolute bottom-0 right-0 w-3 h-3 bg-success border-2 border-white rounded-full"></span>
                                </div>
                                <div class="ps-4 min-w-0">
                                    <div class="text-lg font-semibold text-heading group-hover:text-brand transition-colors duration-200 mb-1 truncate">{{ $user->name }}</div>
                                    <div class="font-normal text-body text-sm truncate">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>

                        <!-- Created At -->
                        <td class="px-4 py-4 text-body hidden md:table-cell">
                            <div class="text-sm">{{ $user->created_at->format('M d, Y') }}</div>
                            <div class="text-xs text-body/70">{{ $user->created_at->diffForHumans() }}</div>
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <button type="button" wire:click="$dispatch('confirm-edit', { userId: {{ $user->id }} })" class="inline-flex items-center font-medium text-brand hover:text-fg-brand hover:underline transition-colors px-2 py-1.5 rounded-md hover:bg-brand-soft/50 cursor-pointer">
                                Edit
                            </button>
                            <button type="button" wire:click="$dispatch('confirm-delete', { userId: {{ $user->id }} })" class="inline-flex items-center font-medium text-danger hover:text-fg-danger-strong hover:underline transition-colors px-2 py-1.5 rounded-md hover:bg-danger-soft/50 cursor-pointer">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-24 text-center">
                            <div class="flex flex-col items-center justify-center text-body">
                                <svg class="w-16 h-16 mb-4 text-body/20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                                @if($search)
                                    <p class="text-lg font-medium text-heading mb-1">No users found</p>
                                    <p class="text-sm">No results for "{{ $search }}"</p>
                                @else
                                    <p class="text-lg font-medium text-heading mb-1">No users yet</p>
                                    <p class="text-sm">Create your first user to get started</p>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($users->hasPages())
            <div class="py-4 px-6 border-t border-default-medium bg-neutral-primary-soft">
                {{ $users->onEachSide(0)->links('livewire.pagination') }}
            </div>
        @endif
    </div>
    
    <!-- Confirmation Modal Component (Single Delete) -->
    @livewire('confirmation')
    
    <!-- Edit Modal Component -->
    @livewire('edit-modal')

    <!-- Profile Modal Component -->
    @livewire('profile')

    <!-- Bulk Delete Confirmation Modal -->
    <x-modal name="bulk-delete-modal" max-width="xl" show="showBulkDeleteModal">
        <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
                <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-danger-soft rounded-full sm:mx-0 sm:h-10 sm:w-10">
                    <svg class="w-6 h-6 text-danger" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg font-semibold leading-6 text-heading" id="bulk-delete-modal">Delete Multiple Users</h3>
                    <div class="mt-2">
                        <p class="text-sm text-body">
                            Are you sure you want to delete <span class="font-bold text-danger" x-text="selectedUsers.length"></span> user(s)? This action cannot be undone.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="px-4 py-3 bg-neutral-secondary-medium/50 sm:px-6 sm:flex sm:flex-row-reverse border-t border-default-medium">
            <button wire:click="bulkDelete" 
                    type="button" 
                    class="inline-flex justify-center w-full px-4 py-2 text-sm font-semibold text-white bg-danger rounded-lg shadow-sm hover:bg-danger/90 cursor-pointer sm:ml-3 sm:w-auto transition-colors">
                Delete <span class="ml-1" x-text="selectedUsers.length"></span> User(s)
            </button>
            <button wire:click="closeBulkDeleteModal" 
                    type="button" 
                    class="mt-3 inline-flex justify-center w-full px-4 py-2 text-sm font-semibold text-heading bg-white ring-1 ring-inset ring-default-medium rounded-lg shadow-sm hover:bg-neutral-secondary-medium cursor-pointer sm:mt-0 sm:w-auto transition-colors">
                Cancel
            </button>
        </div>
    </x-modal>
</div>