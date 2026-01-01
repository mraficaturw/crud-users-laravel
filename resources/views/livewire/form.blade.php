<div class="w-1/2 m-auto mt-20 mb-10">
    <h1 class="text-3xl font-semibold mb-6 text-center">Create User</h1>
    
    <form wire:submit="createUsers" class="w-full mx-auto">
        <!-- Name Input -->
        <x-form-input 
            label="Your name" 
            name="name" 
            placeholder="John Doe" 
        />
        
        <!-- Email Input -->
        <x-form-input 
            label="Your email" 
            name="email" 
            type="text"
            placeholder="example@gmail.com" 
        />
        
        <!-- Password Input -->
        <x-form-input 
            label="Your password" 
            name="password" 
            type="password"
            placeholder="••••••••" 
        />

        {{-- Profile Picture Upload Section --}}
        <div class="col-span-full mb-5">
            <label for="profile-picture" class="block text-xl font-medium text-heading">
                {{ $avatar ? 'Preview' : 'Profile Picture Upload' }}
            </label>
            <div class="mt-2 relative flex justify-center items-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10 min-h-[180px]">
                {{-- Loading Overlay --}}
                <div wire:loading.delay.shortest wire:target="avatar" class="absolute inset-0 z-10 rounded-lg bg-white/50 backdrop-blur-md">
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center">
                        <div class="relative">
                            <div class="w-12 h-12 border-4 border-brand/30 rounded-full"></div>
                            <div class="w-12 h-12 border-4 border-brand border-t-transparent rounded-full animate-spin absolute top-0 left-0"></div>
                        </div>
                        <p class="mt-3 text-sm font-semibold text-brand">Uploading...</p>
                    </div>
                </div>

                @if ($avatar)
                {{-- Avatar Preview --}}
                <div class="text-center">
                    <div class="relative w-24 h-24 mx-auto">
                        <img src="{{ $avatar->temporaryUrl() }}" alt="Avatar Preview" class="w-full h-full object-cover rounded-full">
                        <button type="button" wire:click="removeAvatar" class="absolute top-0 right-0 bg-danger text-white rounded-full p-1 shadow-sm hover:bg-fg-danger-strong transition flex items-center justify-center hover:cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                @else
                {{-- Upload Content --}}
                <div class="text-center">
                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="mx-auto size-12 text-gray-300">
                        <path d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" fill-rule="evenodd" />
                    </svg>
                    <div class="mt-4 flex text-sm/6 text-gray-600">
                        <label for="file-upload" class="relative cursor-pointer rounded-md bg-transparent font-semibold text-brand focus-within:outline-2 focus-within:outline-offset-2 focus-within:outline-brand hover:text-fg-brand">
                            <span>Upload a file</span>
                            <input id="file-upload" type="file" name="file-upload" class="sr-only" wire:model="avatar" accept="image/jpeg, image/jpg, image/png" />
                        </label>
                        <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs/5 text-gray-600">PNG, JPG, JPEG up to 5MB</p>
                </div>
                @endif
            </div>
            @error('avatar')<p class="mt-2.5 text-sm text-fg-danger-strong"><span class="font-medium">{{ $message }}</span></p>@enderror
        </div>

        <button type="submit" class="text-white bg-brand hover:bg-fg-brand px-5 py-2.5 rounded-lg font-medium text-sm cursor-pointer my-3 block w-full">Create</button>
    </form>
</div>
