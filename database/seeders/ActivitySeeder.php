<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Activity::factory()->create([
            'name' => 'Running',
            'type' => 'outside',
            'intensity' => 'high',
            'category' => 'cardio',
            'calories_burned' => 500,
            'average_duration' => 30,
            'equipment_required' => 'none',
        ]);

        \App\Models\Activity::factory()->create([
            'name' => 'Swimming',
            'type' => 'both',
            'intensity' => 'high',
            'category' => 'cardio',
            'calories_burned' => 500,
            'average_duration' => 30,
            'equipment_required' => 'none',
        ]);

        \App\Models\Activity::factory()->create([
            'name' => 'Cycling',
            'type' => 'both',
            'intensity' => 'high',
            'category' => 'cardio',
            'calories_burned' => 500,
            'average_duration' => 30,
            'equipment_required' => 'bike',
        ]);

        \App\Models\Activity::factory()->create([
            'name' => 'Jumping rope',
            'type' => 'both',
            'intensity' => 'high',
            'category' => 'cardio',
            'calories_burned' => 500,
            'average_duration' => 30,
            'equipment_required' => 'jump rope',
        ]);

        \App\Models\Activity::factory()->create([
            'name' => 'Elliptical',
            'type' => 'inside',
            'intensity' => 'medium',
            'category' => 'cardio',
            'calories_burned' => 300,
            'average_duration' => 30,
            'equipment_required' => 'elliptical machine',
        ]);

        \App\Models\Activity::factory()->create([
            'name' => 'Stair climbing',
            'type' => 'both',
            'intensity' => 'high',
            'category' => 'cardio',
            'calories_burned' => 300,
            'average_duration' => 30,
            'equipment_required' => 'stair climber machine or stairs',
        ]);

        \App\Models\Activity::factory()->create([
            'name' => 'Rowing',
            'type' => 'inside',
            'intensity' => 'high',
            'category' => 'cardio',
            'calories_burned' => 300,
            'average_duration' => 30,
            'equipment_required' => 'rowing machine',
        ]);

        \App\Models\Activity::factory()->create([
            'name' => 'Tabata',
            'type' => 'both',
            'intensity' => 'high',
            'category' => 'cardio',
            'calories_burned' => 300,
            'average_duration' => 4,
            'equipment_required' => 'none',
        ]);

        \App\Models\Activity::factory()->create([
            'name' => 'Yoga',
            'type' => 'both',
            'intensity' => 'low',
            'category' => 'strength',
            'calories_burned' => 200,
            'average_duration' => 60,
            'equipment_required' => 'mat',
        ]);

        \App\Models\Activity::factory()->create([
            'name' => 'Pilates',
            'type' => 'both',
            'intensity' => 'medium',
            'category' => 'strength',
            'calories_burned' => 200,
            'average_duration' => 60,
            'equipment_required' => 'mat',
        ]);

        \App\Models\Activity::factory()->create([
            'name' => 'Bodyweight exercises',
            'type' => 'both',
            'intensity' => 'high',
            'category' => 'strength',
            'calories_burned' => 200,
            'average_duration' => 30,
            'equipment_required' => 'none',
        ]);

        \App\Models\Activity::factory()->create([
            'name' => 'Weightlifting',
            'type' => 'inside',
            'intensity' => 'high',
            'category' => 'strength',
            'calories_burned' => 200,
            'average_duration' => 30,
            'equipment_required' => 'weights',
        ]);

        \App\Models\Activity::factory()->create([
            'name' => 'Barre',
            'type' => 'inside',
            'intensity' => 'medium',
            'category' => 'strength',
            'calories_burned' => 200,
            'average_duration' => 60,
            'equipment_required' => 'ballet barre or sturdy chair',
        ]);

        \App\Models\Activity::factory()->create([
            'name' => 'Bootcamp',
            'type' => 'both',
            'intensity' => 'high',
            'category' => 'strength',
            'calories_burned' => 200,
            'average_duration' => 60,
            'equipment_required' => 'weights',
        ]);

        \App\Models\Activity::factory()->create([
            'name' => 'Kickboxing',
            'type' => 'both',
            'intensity' => 'high',
            'category' => 'strength',
            'calories_burned' => 200,
            'average_duration' => 30,
            'equipment_required' => 'none',
        ]);

        \App\Models\Activity::factory()->create([
            'name' => 'Zumba',
            'type' => 'inside',
            'intensity' => 'high',
            'category' => 'strength',
            'calories_burned' => 200,
            'average_duration' => 60,
            'equipment_required' => 'none',
        ]);

        \App\Models\Activity::factory()->create([
            'name' => 'Dance cardio',
            'type' => 'inside',
            'intensity' => 'high',
            'category' => 'strength',
            'calories_burned' => 200,
            'average_duration' => 30,
            'equipment_required' => 'none',
        ]);

        \App\Models\Activity::factory()->create([
            'name' => 'CrossFit',
            'type' => 'both',
            'intensity' => 'high',
            'category' => 'strength',
            'calories_burned' => 200,
            'average_duration' => 60,
            'equipment_required' => 'weights',
        ]);

        \App\Models\Activity::factory()->create([
            'name' => 'Hiking',
            'type' => 'outside',
            'intensity' => 'medium',
            'category' => 'strength',
            'calories_burned' => 200,
            'average_duration' => 30,
            'equipment_required' => 'none',
        ]);

        \App\Models\Activity::factory()->create([
            'name' => 'Rock climbing',
            'type' => 'both',
            'intensity' => 'high',
            'category' => 'strength',
            'calories_burned' => 600,
            'average_duration' => 60,
            'equipment_required' => 'climbing shoes',
        ]);

        \App\Models\Activity::factory()->create([
            'name' => 'Surfing',
            'type' => 'outside',
            'intensity' => 'high',
            'category' => 'strength',
            'calories_burned' => 600,
            'average_duration' => 30,
            'equipment_required' => 'surfboard',
        ]);

        \App\Models\Activity::factory()->create([
            'name' => 'Skiing',
            'type' => 'outside',
            'intensity' => 'high',
            'category' => 'strength',
            'calories_burned' => 600,
            'average_duration' => 30,
            'equipment_required' => 'skis',
        ]);
    }
}
