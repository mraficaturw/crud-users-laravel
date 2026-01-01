<div>
    <label for="table-search" class="sr-only">Search</label>
    <div class="relative w-full md:w-auto">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/></svg>
        </div>
        <input type="text" wire:model.live.debounce.500ms="searchQuery" id="table-search" class="block w-full md:w-80 ps-10 pe-4 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-lg focus:ring-2 focus:ring-brand focus:border-brand shadow-sm placeholder:text-body transition-all duration-200" placeholder="Search users...">
        @foreach ($results as $user)
            {{ $user->name }}
        @endforeach
    </div>
</div>
