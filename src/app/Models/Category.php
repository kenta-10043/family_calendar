<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_id',
        'category',
    ];

    public function schedules()
    {
        return $this->belongsToMany(Schedule::class);
    }
}
