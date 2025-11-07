<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\CategoryName;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function getLabelAttribute(): string
    {
        return CategoryName::from($this->category)->label();
    }
}
