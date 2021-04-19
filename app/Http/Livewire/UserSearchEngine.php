<?php

namespace App\Http\Livewire;

use App\User\Customer\Customer;
use Livewire\Component;

class UserSearchEngine extends Component
{
    public $search = '';
    public function render()
    {
        return view('livewire.user-search-engine', [
            'users' => Customer::where('first_name', $this->search)->get(),
        ]);
    }
}
