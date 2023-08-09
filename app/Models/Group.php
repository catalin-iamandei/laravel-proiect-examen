<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public $fillable = ['name', 'finished_at', 'exam_at', 'started_at'];

    /**
    * Get the users that is in the group.
    */
    // public function users()
    // {
    //     return $this->hasMany(User::class);
    // }

}
