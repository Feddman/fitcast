<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UserActivities extends Model
{
    use HasFactory;
    protected $table = 'userActivities';

    public function users(){
        return $this->hasMany(User::class);
    }

    public function activities(){
        return $this->hasMany(Activity::class);
    }
    
}
