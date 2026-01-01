<div>
    <x-modal name="delete-modal" max-width="xl">
        <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
                <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-danger-soft rounded-full sm:mx-0 sm:h-10 sm:w-10">
                    <svg class="w-6 h-6 text-danger" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg font-semibold leading-6 text-heading" id="delete-modal">Delete User</h3>
                    <div class="mt-2">
                        <p class="text-sm text-body">
                            Are you sure you want to delete <span class="font-bold text-heading">{{ $userName }}</span>? This action cannot be undone.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="px-4 py-3 bg-neutral-secondary-medium/50 sm:px-6 sm:flex sm:flex-row-reverse border-t border-default-medium">
            <button wire:click="delete" type="button" class="inline-flex justify-center w-full px-3 py-2 bg-white text-sm font-semibold text-danger rounded-md shadow-sm hover:bg-danger hover:text-white cursor-pointer sm:ml-3 sm:w-auto transition-colors">
                Delete Data
            </button>
            <button wire:click="closeModal" type="button" class="mt-3 inline-flex justify-center w-full px-3 py-2 text-sm font-semibold text-heading bg-white ring-1 ring-inset ring-default-medium rounded-md shadow-sm hover:bg-neutral-secondary-medium hover:cursor-pointer sm:mt-0 sm:w-auto transition-colors">
                Cancel
            </button>
        </div>
    </x-modal>
</div>