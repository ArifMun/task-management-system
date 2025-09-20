<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'name',
        'description',
        'status_id',
        'severity_id',
        'developer_id',
        'start_date',
        'due_date',
        'finish_date',
        'created_by'
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function severity()
    {
        return $this->belongsTo(Severity::class);
    }

    public function developer()
    {
        return $this->belongsTo(User::class, 'developer_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
