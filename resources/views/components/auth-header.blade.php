@props([
    'title',
    'description',
])

<div class="flex w-full flex-col text-center">
    <flux:heading size="xl" class="">{{ $title }}</flux:heading>
    <flux:subheading class="">{{ $description }}</flux:subheading>
</div>
