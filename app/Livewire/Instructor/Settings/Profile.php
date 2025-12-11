<?php

namespace App\Livewire\Instructor\Settings;

use App\Livewire\Instructor\BaseComponent;

class Profile extends BaseComponent
{
    use \Livewire\WithFileUploads;

    public $name = "";
    public $email = "";
    public $phone_no = "";
    public $address = "";
    public $gender = "";
    public $date_of_birth = "";
    public $occupation = "";
    public $organization = "";
    public $image_path;
    
    public function mount()
    {
        // auth()->user() is a helper function that returns the authenticated user
        /**
         * @var \App\Models\User|null $user
         */
        $user = auth()->user();
        $this->name = $user?->name ?? '';
        $this->email = $user?->email ?? '';
        $this->phone_no = $user?->phone_no ?? '';
        $this->address = $user?->address ?? '';
        $this->gender = $user?->gender ?? 'Male';
        $this->date_of_birth = $user?->date_of_birth ?? '';
        $this->occupation = $user?->occupation ?? '';
        $this->organization = $user?->organization ?? '';
        $this->image_path = $user?->image_path ?? '';
    }

    public function updateProfile()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_no' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'gender' => 'required|in:Male,Female,Other',
            'date_of_birth' => 'nullable|date',
            'occupation' => 'nullable|string|max:255',
            'organization' => 'nullable|string|max:255',
            'image_path' => 'nullable',
        ]);

        if ($this->image_path instanceof \Illuminate\Http\UploadedFile) {
            $validated['image_path'] = $this->image_path->store('profile-photos', 'public');
        } else {
            unset($validated['image_path']);
        }

        $user->update($validated);

        $this->dispatch('profile-updated'); 
        // Or if you use a toaster:
        // $this->dispatch('notify', 'Profile updated successfully!');
    }

    public function render()
    {
        return view('livewire.instructor.settings.profile');
    }
}
