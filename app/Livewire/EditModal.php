<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;

/**
 * EditModal Component - User edit form in modal
 * 
 * Handles editing user name, email, and optional password change
 * with proper validation.
 */
class EditModal extends Component
{
    public bool $isOpen = false;
    public ?int $userId = null;
    public ?string $userName = null;
    public ?string $userEmail = null;
    public string $currentPassword = '';
    public string $newPassword = '';
    public string $confirmPassword = '';
    public string $passwordError = '';

    /**
     * Open the edit modal and populate with user data
     */
    #[On('confirm-edit')]
    public function openModal(int $userId): void
    {
        $user = User::find($userId);
        if ($user) {
            $this->userId = $user->id;
            $this->userName = $user->name;
            $this->userEmail = $user->email;
            $this->currentPassword = '';
            $this->newPassword = '';
            $this->confirmPassword = '';
            $this->passwordError = '';
            $this->isOpen = true;
        }
    }

    /**
     * Close the modal and reset all fields
     */
    public function closeModal(): void
    {
        $this->isOpen = false;
        $this->reset(['userId', 'userName', 'userEmail', 'currentPassword', 'newPassword', 'confirmPassword', 'passwordError']);
    }

    /**
     * Update user with validated data
     */
    public function edit(): void
    {
        $this->passwordError = '';

        if (!$this->userId) {
            return;
        }

        $user = User::find($this->userId);
        if (!$user) {
            return;
        }

        $updateData = [
            'name' => $this->userName,
            'email' => $this->userEmail,
        ];

        // Only process password if user wants to change it
        if (!empty($this->newPassword) || !empty($this->confirmPassword) || !empty($this->currentPassword)) {
            // Validate current password is provided
            if (empty($this->currentPassword)) {
                $this->passwordError = 'Please enter your current password.';
                return;
            }

            // Validate current password is correct
            if (!Hash::check($this->currentPassword, $user->password)) {
                $this->passwordError = 'Current password is incorrect.';
                return;
            }

            // Validate new password is provided
            if (empty($this->newPassword)) {
                $this->passwordError = 'Please enter a new password.';
                return;
            }

            // Validate new password matches confirmation
            if ($this->newPassword !== $this->confirmPassword) {
                $this->passwordError = 'Password confirmation does not match.';
                return;
            }

            // Validate new password is different from current
            if (Hash::check($this->newPassword, $user->password)) {
                $this->passwordError = 'New password cannot be the same as current password.';
                return;
            }

            // Hash and add new password to update data
            $updateData['password'] = Hash::make($this->newPassword);
        }

        $user->update($updateData);
        $this->closeModal();
        session()->flash('Edited', 'User successfully updated.');
        $this->redirect('/users');
    }

    public function render()
    {
        return view('livewire.edit-modal');
    }
}
