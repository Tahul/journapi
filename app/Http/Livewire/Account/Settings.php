<?php

namespace App\Http\Livewire\Account;

use Illuminate\Validation\Rule;
use Livewire\Component;

class Settings extends Component
{
    public $name;
    public $email;
    public $apiKey;
    public $timezone;
    public $timezones;

    public function render()
    {
        return view('livewire.account.settings')
            ->extends('layouts.app')
            ->section('content');
    }

    public function mount()
    {
        $this->timezones = get_timezones();

        $user = auth()->user();

        $this->email = $user->email;

        $this->name = $user->name;

        $this->timezone = $user->timezone;

        $this->apiKey = $user->apiKey;
    }

    public function updated()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'timezone' => [
                'required',
                Rule::in($this->timezones)
            ]
        ]);

        $user = auth()->user();

        $user->name = $this->name;

        $user->email = $this->email;

        $user->timezone = $this->timezone;

        $user->save();

        session()->flash('success', '✅ Changes saved.');
    }

    public function regenerateApiKey()
    {
        $user = auth()->user();

        $user->generateApiKey();

        $this->apiKey = $user->apiKey;

        session()->flash('success', '✅ API key regenerated.');
    }
}
