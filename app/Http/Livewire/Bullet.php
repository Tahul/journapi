<?php

namespace App\Http\Livewire;

use App\Models\Bullet as BulletModel;
use Livewire\Component;

class Bullet extends Component
{
    public $bullet;
    public $bulletEdit;

    protected $listeners = ['resetEdit' => 'resetEdit'];

    public function render()
    {
        return view('livewire.bullet');
    }

    public function mount($bullet)
    {
        $this->bullet = $bullet;

        $this->bulletEdit = $bullet->bullet;
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
            'bulletEdit' => 'required'
        ]);

        $bullet = auth()->user()->bullets->find($this->bullet->id);

        $bullet->bullet = $this->bulletEdit;

        $this->bullet = $bullet;

        $bullet->save();

        $this->emit('refresh');
    }
}
