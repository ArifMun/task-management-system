<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Severity extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'color',
        'sort_order'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
