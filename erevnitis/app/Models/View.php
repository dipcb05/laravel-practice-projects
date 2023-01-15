<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $guarded = [];
    protected $fillable = ['users_id', 'posts_id', 'reviews_id'];
    protected $table = "views";

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    public function posts()
    {
        return $this->belongsTo(posts::class, 'posts_id', 'id');
    }
    public function reviews()
    {
        return $this->belongsTo(Review::class, 'reviews_id', 'id');
    }
}
