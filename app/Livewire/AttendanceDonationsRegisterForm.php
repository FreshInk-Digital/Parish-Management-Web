<?php

namespace App\Livewire;

use App\Models\Group;
use Livewire\Component;

class AttendanceDonationsRegisterForm extends Component
{
    public $category = '';
    public $groups;

    public function mount()
    {
        $this->groups = Group::all();
    }
    
    public function render()
    {
        return view('livewire.attendance-donations-register-form');
    }
}
