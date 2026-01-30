<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $table= "labels";

    protected $fillable = [
        "name",
        "color"
    ];

    public function tasks(){
        return $this ->belongsToMany(Task::class, 'label_tasks', 'label_id','task_id');
    }

  
}
