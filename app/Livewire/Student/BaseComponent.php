<?php

namespace App\Livewire\Student;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.student')]
abstract class BaseComponent extends Component
{
    // All student components will automatically use layouts.student
}
