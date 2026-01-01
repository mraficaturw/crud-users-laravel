<div>
    <x-modal name="edit-modal" max-width="lg">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-default-medium bg-neutral-secondary-medium/30">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="flex items-center justify-center w-10 h-10 bg-brand-soft rounded-full">
                        <svg class="w-5 h-5 text-brand" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-heading" id="edit-modal">Edit User</h3>
                </div>
                <button type="button" 
                        wire:click="closeModal" 
                        class="p-2 rounded-lg text-body hover:text-heading hover:bg-neutral-secondary-medium transition-colors cursor-pointer">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Form Body -->
        <form wire:submit.prevent="edit" class="px-6 py-5">
            <!-- Name Field -->
            <div class="mb-5">
                <label for="edit-name" class="block mb-2.5 text-sm font-medium text-heading">Name</label>
                <input type="text" 
                       id="edit-name" 
                       wire:model="userName"
                       class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-lg focus:ring-2 focus:ring-brand focus:border-brand block w-full px-4 py-3 shadow-xs placeholder:text-body transition-all duration-200" 
                       placeholder="Enter user name" 
                       required />
                @error('userName') <span class="text-sm text-danger mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Email Field -->
            <div class="mb-5">
                <label for="edit-email" class="block mb-2.5 text-sm font-medium text-heading">Email</label>
                <input type="email" 
                       id="edit-email" 
                       wire:model="userEmail"
                       class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-lg focus:ring-2 focus:ring-brand focus:border-brand block w-full px-4 py-3 shadow-xs placeholder:text-body transition-all duration-200" 
                       placeholder="example@company.com" 
                       required />
                @error('userEmail') <span class="text-sm text-danger mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Password Section Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-default-medium"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-3 bg-white text-body">Change Password (Optional)</span>
                </div>
            </div>

            <!-- Password Error Alert -->
            @if($passwordError)
            <div class="mb-5 p-4 rounded-lg bg-danger-soft border border-danger/20 flex items-start space-x-3">
                <svg class="w-5 h-5 text-danger flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                <span class="text-sm text-danger font-medium">{{ $passwordError }}</span>
            </div>
            @endif

            <!-- Current Password Field -->
            <div class="mb-5">
                <label for="current-password" class="block mb-2.5 text-sm font-medium text-heading">Current Password</label>
                <input type="password" 
                       id="current-password" 
                       wire:model="currentPassword"
                       class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-lg focus:ring-2 focus:ring-brand focus:border-brand block w-full px-4 py-3 shadow-xs placeholder:text-body transition-all duration-200" 
                       placeholder="Enter your current password" />
                <p class="mt-2 text-xs text-body">Required to change password.</p>
            </div>

            <!-- New Password Field -->
            <div class="mb-5">
                <label for="new-password" class="block mb-2.5 text-sm font-medium text-heading">New Password</label>
                <input type="password" 
                       id="new-password" 
                       wire:model="newPassword"
                       class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-lg focus:ring-2 focus:ring-brand focus:border-brand block w-full px-4 py-3 shadow-xs placeholder:text-body transition-all duration-200" 
                       placeholder="Enter new password" />
            </div>

            <!-- Confirm New Password Field -->
            <div class="mb-5">
                <label for="confirm-password" class="block mb-2.5 text-sm font-medium text-heading">Confirm New Password</label>
                <input type="password" 
                       id="confirm-password" 
                       wire:model="confirmPassword"
                       class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-lg focus:ring-2 focus:ring-brand focus:border-brand block w-full px-4 py-3 shadow-xs placeholder:text-body transition-all duration-200" 
                       placeholder="Confirm new password" />
                <p class="mt-2 text-xs text-body">Leave all password fields blank if you don't want to change the password.</p>
            </div>
        
            <!-- Footer / Actions -->
            <div class="flex flex-row-reverse gap-3 pt-4 border-t border-default-medium">
                <button type="submit" class="inline-flex justify-center items-center px-5 py-2.5 bg-brand text-sm font-semibold text-white rounded-lg shadow-sm hover:bg-brand-strong focus:ring-4 focus:ring-brand-soft transition-colors cursor-pointer">
                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    Save Changes
                </button>
                <button wire:click="closeModal" type="button" class="inline-flex justify-center items-center px-5 py-2.5 text-sm font-semibold text-heading bg-white ring-1 ring-inset ring-default-medium rounded-lg shadow-sm hover:bg-neutral-secondary-medium transition-colors cursor-pointer">
                    Cancel
                </button>
            </div>
        </form>
    </x-modal>
</div>
