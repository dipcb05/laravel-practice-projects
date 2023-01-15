<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class message extends Model
{
    protected $guarded = [];
    protected $fillable = ['users_id', 'others_id', 'message'];
    protected $table = "messages";

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
