<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class discussion_comments extends Model
{
    protected $guarded = [];
    protected $fillable = ['users_id', 'discussions_id', 'comment'];
    protected $table = "discussions_comments";

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    public function discussions()
    {
        return $this->belongsTo(Discussion::class, 'discussions_id', 'id');
    }

}
