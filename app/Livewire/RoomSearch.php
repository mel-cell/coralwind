<?php

namespace App\Livewire;

use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RoomSearch extends Component
{
    public $tipe_kamar = '';
    public $rooms = [];
    public $showResults = false;

    protected $rules = [
        'tipe_kamar' => 'nullable|string',
    ];

    public function mount()
    {
        $this->performSearch();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        $this->performSearch();
    }

    public function performSearch()
    {
        $this->validate();

        $query = Room::query();



        if ($this->tipe_kamar) {
            $query->where('tipe_kamar', $this->tipe_kamar);
        }

        $this->rooms = $query->limit(9)->get();

        $this->showResults = true;
    }

    public function search()
    {
        $this->performSearch();
    }

    public function render()
    {
        return view('livewire.room-search');
    }
}
