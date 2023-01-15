<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];
    protected $fillable = ['users_id','country', 'bdate', 'job', 'wdate', 'des', 'web', 'pic'];
    protected $table = "profiles";
    //protected $redirectTo = RouteServiceProvider::HOME;
	public function users()
	{
    return $this->belongsTo(User::class, 'users_id', 'id');
    }
    public function followers()
    {
        return $this->belongsToMany(User::class, 'users', 'users_id');
    }



}
