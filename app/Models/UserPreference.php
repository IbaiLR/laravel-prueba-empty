<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
   protected $table = "user_preferences";
    protected $fillable = [
    'user_id', 
    'dark_mode', 
    'notifications_enabled', 
    'compact_view'
];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
