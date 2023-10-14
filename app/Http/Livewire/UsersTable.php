<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class UsersTable extends Component
{
    public function render()
    {
        return view('livewire.users-table',[
            'users' => User::all()
        ]);
    }
}
