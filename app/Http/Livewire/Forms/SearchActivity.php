<?php

namespace App\Http\Livewire\Forms;

use Illuminate\Support\Facades\Auth;
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
        $query = \App\Models\Activity::where('category', $this->activityType)
            ->where('intensity', $this->intensity);

        if ($type !== 'both') {
            $query->where('type', $type);
        }

        $activities = $query->get();

        if(!$activities->count()) {
            $this->addError('chosenActivity', 'No activities found for this weather condition');
            return;
        }

        if (Auth::check()) {
            // filter activities to only contain preferred activities
            $newActivities = $activities->filter(function ($activity) {
                return Auth::user()->favoriteActivities->contains($activity);
            });

            if($newActivities->count()) {
                $activities = $newActivities;
            }else{
                $this->addError('noFavoriteActivities', 'No activities found for this weather condition in your favorites. This is a random activity.');
            }
        }
        
        $this->chosenActivity = $activities->random();
    }

    public function render()
    {
        return view('livewire.forms.search-activity');
    }
}
