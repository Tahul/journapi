<?php

namespace App\Http\Livewire\Account;

use App\Models\Bullet;
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

    public function submit()
    {
        $messages = Bullet::messages()['create'];

        Bullet::create([
            'user_id' => auth()->user()->id,
            'published_at' => now()->timezone(auth()->user()->timezone),
            'bullet' => $this->bullet,
            'urls' => unfurl_string($this->bullet)
        ]);

        session()->flash('success', $messages['success']);

        $this->bullet = '';
    }

    public function delete($id)
    {
        $bullet = auth()->user()->bullets->find($id);

        if (is_null($bullet)) {
            throw new Exception('bullet_not_found');
        }

        $bullet->delete();
    }
}
