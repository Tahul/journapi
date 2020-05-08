<?php

namespace App\Http\Livewire\Account;

use Livewire\Component;

class Journal extends Component
{
    public $bullet;

    public function render()
    {
        return view('livewire.account.journal', [
            'bullets' => auth()->user()->bullets->groupBy(function ($item) {
                return $item->published_at->format('d M y');
            })
        ]);
    }
}
