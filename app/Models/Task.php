<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable=[
        'user_id',
        'title',
        'description',
        'is_completed'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    } 

    public function labels(){
        return $this -> belongsToMany(Label::class, 'label_tasks', 'label_id', 'task_id');
    }

    
}
