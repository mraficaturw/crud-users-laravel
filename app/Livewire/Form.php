<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Buglinjo\LaravelWebp\Webp;
use Illuminate\Http\UploadedFile;

/**
 * Form Component - User creation form
 * 
 * Handles creating new users with avatar upload
 * and WebP image conversion.
 */
class Form extends Component
{
    use WithFileUploads;

    #[Validate('required|min:3|max:255')]
    public string $name = '';

    #[Validate('required|email:dns|unique:users')]
    public string $email = '';

    #[Validate('required|min:8')]
    public string $password = '';

    #[Validate('nullable|image|mimes:jpeg,png,jpg|max:5120')]
    public $avatar = null;

    /**
     * Create a new user with optional avatar
     */
    public function createUsers(): void
    {
        $validated = $this->validate();

        $avatarPath = null;

        if ($this->avatar instanceof UploadedFile) {
            $avatarPath = $this->processAvatarUpload();
        }

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'avatar' => $avatarPath
        ]);

        $this->reset();

        session()->flash('success', 'User successfully created.');

        $this->redirect('/users');
    }

    /**
     * Process and save avatar as WebP
     */
    private function processAvatarUpload(): string
    {
        $filename = uniqid() . '.webp';
        $relativePath = 'avatars/' . $filename;
        $absolutePath = storage_path('app/public/' . $relativePath);

        // Ensure the directory exists
        $directory = storage_path('app/public/avatars');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        // Save the WebP image
        Webp::make($this->avatar)->save($absolutePath);

        return $relativePath;
    }

    /**
     * Remove the selected avatar
     */
    public function removeAvatar(): void
    {
        $this->reset('avatar');
    }

    public function render()
    {
        return view('livewire.form');
    }
}
