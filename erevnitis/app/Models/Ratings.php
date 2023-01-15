<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    protected $guarded = [];
    protected $fillable = ['users_id','ratings'];
    protected $table = "user_ratings";
    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }



}
