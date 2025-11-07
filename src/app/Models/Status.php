<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\TaskStatus;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'changed_at',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function getLabelAttribute(): string
    {
        return TaskStatus::from($this->status)->label();
    }
}
