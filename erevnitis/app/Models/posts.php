<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class posts extends Model
{
	protected $guarded = [];
    protected $fillable = ['pcaption', 'posts', 'author', 'subject', 'journal', 'time'];
    protected $table = 'posts';
    /**
     * @var mixed
     */

    /**
     * @var mixed
     */


    /**
     * @var mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'posts_id', 'id');
    }

}
