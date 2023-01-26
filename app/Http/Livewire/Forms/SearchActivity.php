<?php

namespace App\Http\Livewire\Forms;
use Livewire\Component;

class SearchActivity extends Component
{
    const WEATHER_CODES = [
        '01d' => 'both',
        '01n' => 'both',
        '02d' => 'both',
        '02n' => 'both',
        '03d' => 'both',
        '03n' => 'both',
        '04d' => 'both',
        '04n' => 'both',
        '09d' => 'indoor',
        '09n' => 'indoor',
        '10d' => 'indoor',
        '10n' => 'indoor',
        '11d' => 'indoor',
        '11n' => 'indoor',
        '13d' => 'indoor',
        '13n' => 'indoor',
        '50d' => 'both',
        '50n' => 'both',
    ];

    public $activityType;
    public $startTime;
    public $intensity;
    public $weatherCode;
    public $chosenActivity;

    public function mount()
    {
        $this->activityType = 'cardio';
        $this->intensity = 'high';
        $this->startTime = now();
    }

    public function hydrateStartTime($value)
    {
        $this->startTime = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $value);
    }

    public function dehydrateStartTime($value)
    {
        if($value instanceof \Carbon\Carbon)
            $this->startTime = $value->format('Y-m-d\TH:i');
        else
            $this->startTime = $value;
    }

    public function resetActivity() {
        $this->chosenActivity = null;
    }

    public function findActivities()
    {
        $type = self::WEATHER_CODES[$this->weatherCode];
        $activities = \App\Models\Activity::where('type', $type)
            ->where('type', $type)
            ->where('category', $this->activityType)
            ->where('intensity', $this->intensity)
            ->get();
        if(count($activities)) {
            $this->chosenActivity = $activities->random();
        } else {

        }

    }

    public function render()
    {
        return view('livewire.forms.search-activity');
    }
}
