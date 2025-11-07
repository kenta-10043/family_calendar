<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_id',
        'category_id',
        'task',
        'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault(
            [
                'category' => 0,
            ]
        );
    }

    public function status()
    {
        return $this->belongsTo(Status::class)->withDefault(
            [
                'status' => 0,
            ]
        );
    }


    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
