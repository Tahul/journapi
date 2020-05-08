<?php

namespace App\Http\Livewire\Account;

use App\Models\Bullet;
use Carbon\Carbon;
use Exception;
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

    public function mount()
    {
        $user = auth()->user();
    }

    public function addBullet($bullet)
    {
        $this->validate([
            'bullet' => 'required|min:3',
        ]);

        try {
            Bullet::create([
                'user_id' => auth()->user()->id,
                'published_at' => now()->timezone(auth()->user()->timezone),
                'bullet' => $bullet
            ]);

            session()->flash('success', '✅ Bullet saved!');

            redirect()->to('/journal');
        } catch (Exception $e) {
            session()->flash('error', '❌ Could not save bullet.');
        }
    }
}
