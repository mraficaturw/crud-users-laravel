<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;

/**
 * Profile Component - User profile view modal
 * 
 * Displays user details in a modal with option to edit.
 */
class Profile extends Component
{
    public bool $isOpen = false;
    public ?int $userId = null;
    public ?string $userName = null;
    public ?string $userEmail = null;
    public ?string $userAvatar = null;
    public ?string $userCreatedAt = null;

    /**
     * Open the profile modal with user data
     */
    #[On('view-profile')]
    public function openModal(int $userId): void
    {
        $user = User::find($userId);

        if ($user) {
            $this->userId = $user->id;
            $this->userName = $user->name;
            $this->userEmail = $user->email;
            $this->userAvatar = $user->avatar;
            $this->userCreatedAt = $user->created_at->format('F d, Y');
            $this->isOpen = true;
        }
    }

    /**
     * Close the modal and reset state
     */
    public function closeModal(): void
    {
        $this->isOpen = false;
        $this->reset(['userId', 'userName', 'userEmail', 'userAvatar', 'userCreatedAt']);
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
