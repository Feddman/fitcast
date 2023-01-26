<?php

namespace App\Http\Livewire\Forms;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class SearchActivity extends Component
{
    public $activity;
    public $startTime;
    public $intensity;



    public function query() {

    }

    public function render()
    {
        return view('livewire.forms.search-activity');
    }
}
