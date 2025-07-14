<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.auth',['title' => 'Register'])]
class Register extends Component
{
    public string $name = '';

    public string $email = '';

    public string $role = '';

    public string $password = '';

    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'role' => ['required', 'string','in:student,instructor'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        // need to check at this point if everthing is working and livewire component getting proper data
        // dd($validated, $this->name, $this->email, $this->role);
        // print_r($validated);
        // die();
        if (app()->isLocal()) {
            logger([
                'validated' => $validated,
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
            ]);
        }
        event(new Registered(($user = User::create($validated))));
        $user->assignRole($validated['role']);
        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}
