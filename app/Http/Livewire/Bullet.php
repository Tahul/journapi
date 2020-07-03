<?php

namespace App\Http\Livewire;

use App\Models\Bullet as BulletModel;
use Livewire\Component;

class Bullet extends Component
{
    // Attributes
    public $bullet;
    public $bulletEdit;
    public $publishedAtEdit;
    // Listeners
    protected $listeners = ['resetEdit' => 'resetEdit'];

    public function render()
    {
        return view('livewire.bullet');
    }

    public function mount($bullet)
    {
        $this->bullet = $bullet;

        $this->bulletEdit = $bullet->bullet;

        $this->publishedAtEdit = $bullet->published_at->format('Y-m-d\TH:i');
    }

    public function remove()
    {
        $bullet = auth()->user()->bullets->find($this->bullet->id);

        $bullet->delete();

        $this->emit('refresh');
    }

    public function resetEdit()
    {
        $this->bulletEdit = $this->bullet->bullet;
    }

    public function edit()
    {
        $this->validate([
            'bulletEdit' => 'required',
            'publishedAtEdit' => 'required|date_format:Y-m-d\TH:i'
        ]);

        $bullet = auth()->user()->bullets->find($this->bullet->id);

        $bullet->bullet = $this->bulletEdit;

        $bullet->published_at = $this->publishedAtEdit;

        $this->bullet = $bullet;

        $bullet->save();

        $this->emit('refresh');
    }
}
