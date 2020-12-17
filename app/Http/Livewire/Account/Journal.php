<?php

namespace App\Http\Livewire\Account;

use App\Models\Bullet;
use Livewire\Component;

class Journal extends Component
{
    // Attributes
    public ?string $bullet = null;
    public ?string $published_at = null;
    // Listeners
    protected $listeners = ['refresh' => 'render'];

    public function mount()
    {
        $this->published_at = now()->timezone(auth()->user()->timezone)->format('Y-m-d\TH:i');
    }

    public function render()
    {
        $bullets = auth()->user()->bullets->groupBy(function ($item) {
            return $item->published_at->format('d M y');
        });

        if (is_null($bullets)) {
            $bullets = [];
        }

        return view('livewire.account.journal', [
            'bullets' => $bullets
        ])
            ->extends('layouts.app')
            ->section('content');
    }

    public function submit()
    {
        $validation = Bullet::validation()['create'];

        $this->validate($validation);

        Bullet::create([
            'user_id' => auth()->user()->id,
            'published_at' => is_null($this->published_at) ? now()->timezone(auth()->user()->timezone) : $this->published_at,
            'bullet' => $this->bullet
        ]);

        $this->bullet = '';
        $this->published_at = now()->timezone(auth()->user()->timezone)->format('Y-m-d\TH:i');

        $this->render();
    }
}
