<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'project_id', 'task_name', 'task_description', 'task_number'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($task) {
            $lastTaskNumber = Task::where('project_id', $task->project_id)->max('task_number');
            $task->task_number = $lastTaskNumber ? $lastTaskNumber + 1 : 1;
        });
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'task_user');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }


}
