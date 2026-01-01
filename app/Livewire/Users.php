<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

/**
 * Users Component - Main users listing with CRUD operations
 * 
 * Features:
 * - Paginated user listing with search
 * - Sortable columns (name, created_at)
 * - Bulk selection and delete
 * - Alpine.js integration for client-side interactions
 */
class Users extends Component
{
    use WithPagination;

    /** Search query for filtering users */
    public string $search = '';

    /** Current sort column */
    public string $sortBy = 'created_at';

    /** Sort direction (asc/desc) */
    public string $sortDirection = 'desc';

    /** Array of selected user IDs for bulk operations */
    public array $selectedUsers = [];

    /** Toggle for bulk delete confirmation modal */
    public bool $showBulkDeleteModal = false;

    /**
     * Listen for user-deleted event to refresh the list
     */
    #[On('user-deleted')]
    public function refreshUsers(): void
    {
        // Component will auto-refresh
    }

    /**
     * Reset pagination and selection when search changes
     */
    public function updatedSearch(): void
    {
        $this->resetPage();
        $this->selectedUsers = [];
    }

    /**
     * Toggle sort direction or change sort column
     */
    public function setSorting(string $field): void
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
        $this->selectedUsers = [];
    }

    /**
     * Reset selection when page changes
     */
    public function updatedPage(): void
    {
        $this->selectedUsers = [];
    }

    /**
     * Show bulk delete confirmation modal
     */
    public function confirmBulkDelete(): void
    {
        if (count($this->selectedUsers) > 0) {
            $this->showBulkDeleteModal = true;
        }
    }

    /**
     * Close bulk delete confirmation modal
     */
    public function closeBulkDeleteModal(): void
    {
        $this->showBulkDeleteModal = false;
    }

    /**
     * Execute bulk delete operation
     */
    public function bulkDelete(): void
    {
        $count = count($this->selectedUsers);

        if ($count > 0) {
            User::whereIn('id', $this->selectedUsers)->delete();

            session()->flash('deleted', $count . ' user(s) successfully deleted.');

            $this->selectedUsers = [];
            $this->showBulkDeleteModal = false;
        }
    }

    /**
     * Build the base query for users list
     */
    private function getUsersQuery()
    {
        return User::query()
            ->when(
                $this->search,
                fn($query) =>
                $query->where(
                    fn($q) =>
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                )
            )
            ->orderBy($this->sortBy, $this->sortDirection);
    }

    public function render()
    {
        return view('livewire.users', [
            'users' => $this->getUsersQuery()->paginate(10),
        ]);
    }
}
