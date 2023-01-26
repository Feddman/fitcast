<?php

namespace App\Http\Livewire\Forms;
use Livewire\Component;

class SearchActivity extends Component
{
    public $activity;
    public $startTime;
    public $intensity;

    public function mount()
    {
        $this->activity = 'running';
        $this->startTime = now(); //
        $this->intensity = 1;
    }

    public function hydrate()
    {
        $this->startTime = \Carbon\Carbon::parse($this->startTime);
    }

    public function dehydrate()
    {
        $this->startTime = $this->startTime->format('Y-m-d\TH:i');
    }

    public function findActivities()
    {
        dd($this->activity, $this->startTime, $this->intensity);
    }

    public function render()
    {
        return view('livewire.forms.search-activity');
    }
}
