<?php

namespace App\Http\Livewire\Account;

use App\Models\Bullet;
use Livewire\Component;

class Journal extends Component
{
    public $bullet;

    protected $listeners = ['refresh' => 'render'];

    public function render()
    {
        return view('livewire.account.journal', [
            'bullets' => auth()->user()->bullets->groupBy(function ($item) {
                return $item->published_at->format('d M y');
            })
        ]);
    }

    public function submit()
    {
        $validation = Bullet::validation()['create'];

        $this->validate($validation);

        Bullet::create([
            'user_id' => auth()->user()->id,
            'published_at' => now()->timezone(auth()->user()->timezone),
            'bullet' => $this->bullet
        ]);

        $this->bullet = null;

        $this->render();
    }
}
