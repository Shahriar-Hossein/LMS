<?php

namespace App\Livewire\Instructor;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.instructor')]
abstract class BaseComponent extends Component
{
    // All instructor components will automatically use layouts.instructor
}
