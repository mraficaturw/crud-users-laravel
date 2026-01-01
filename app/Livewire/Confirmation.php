<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;

/**
 * Confirmation Component - Delete confirmation modal
 * 
 * Listens for 'confirm-delete' event and shows a confirmation
 * modal before deleting a user.
 */
class Confirmation extends Component
{
    public bool $isOpen = false;
    public ?int $userId = null;
    public ?string $userName = null;

    /**
     * Open the confirmation modal for a specific user
     */
    #[On('confirm-delete')]
    public function openModal(int $userId): void
    {
        $user = User::find($userId);
        if ($user) {
            $this->userId = $user->id;
            $this->userName = $user->name;
            $this->isOpen = true;
        }
    }

    /**
     * Close the modal and reset state
     */
    public function closeModal(): void
    {
        $this->isOpen = false;
        $this->reset(['userId', 'userName']);
    }

    /**
     * Delete the user and redirect with flash message
     */
    public function delete(): void
    {
        if ($this->userId) {
            User::find($this->userId)?->delete();

            $this->reset();

            session()->flash('deleted', 'User successfully deleted.');

            $this->redirect('/users');
        }
    }

    public function render()
    {
        return view('livewire.confirmation');
    }
}
