<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';
    public $admin = '';


    public function delete($id){
        User::destroy($id);
    }

    public function setSortBy($sortByField){
        if($this->sortBy == $sortByField){
            $this->sortDir = ($this->sortDir == 'ASC' ? 'DESC' : 'ASC');
            return;
        }
        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    public function render()
    {

        return view('livewire.users-table',[
            'users' => User::search($this->search)
            ->when($this->admin !== '', function($query){
              $query->where('is_admin', $this->admin);
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage)
        ]);
    }
}
