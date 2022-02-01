<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class news extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'text',
        'publish',
        'date_publish',
        'user_id'
    ];
    public function users(){
        return $this->hasMany(User::class);
    }
}
