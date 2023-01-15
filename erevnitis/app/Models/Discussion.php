<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $guarded = [];
    protected $fillable = ['users_id', 'keyword', 'question', 'rating'];
    protected $table = "discussions";

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
