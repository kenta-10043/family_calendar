<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'task',
    ];

    public function categories()
    {
        return $this->hasOne(Category::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
