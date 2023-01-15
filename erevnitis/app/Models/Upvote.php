<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Upvote extends Model
{
    protected $guarded = [];
    protected $fillable = ['users_id', 'type', 'type_id'];
    protected $table = "upvotes";

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
