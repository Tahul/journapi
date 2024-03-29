<?php

namespace App\Http\Livewire\Account;

use Livewire\Component;

class Delete extends Component
{
    public function render()
    {
        return view('livewire.account.delete')
            ->extends('layouts.app')
            ->section('content');
    }

    public function deleteAccount()
    {
        $user = auth()->user();

        $user->delete();

        return redirect()->to('/');
    }
}
