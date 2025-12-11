<?php

use App\Livewire\Instructor\Settings\Profile;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('instructor profile page is displayed', function () {
    $this->actingAs($user = User::factory()->create());

    $this->get(route('instructor.settings.profile'))->assertOk();
});

test('instructor profile information can be updated', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test(Profile::class)
        ->set('name', 'Updated Name')
        ->set('email', 'updated@example.com')
        ->set('phone_no', '1234567890')
        ->set('gender', 'Male')
        ->call('updateProfile')
        ->assertHasNoErrors();

    $user->refresh();

    expect($user->name)->toEqual('Updated Name');
    expect($user->email)->toEqual('updated@example.com');
    expect($user->phone_no)->toEqual('1234567890');
});

test('instructor can upload profile image', function () {
    Storage::fake('public');

    $file = UploadedFile::fake()->image('profile.jpg');
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test(Profile::class)
        ->set('image_path', $file)
        ->call('updateProfile')
        ->assertHasNoErrors();

    $user->refresh();

    expect($user->image_path)->not->toBeNull();
    Storage::disk('public')->assertExists($user->image_path);
});

test('validation rules are enforced', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test(Profile::class)
        ->set('name', '') // Required
        ->set('email', 'not-an-email') // Invalid email
        ->call('updateProfile')
        ->assertHasErrors(['name', 'email']);
});
