<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
abstract class BaseComponent extends Component
{
    // All admin components will automatically use layouts.admin
}
