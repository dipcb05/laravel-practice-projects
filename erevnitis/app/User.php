<?php
namespace App;
use App\Mail\WelcomeMail;
use App\Models\Admin;
use App\Models\comments;
use App\Models\message;
use App\Models\posts;
use App\Models\Profile;
use App\Models\Ratings;
use App\Models\Review;
use App\Models\Upvote;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
/**
 * @method static find(int|string|null $id)
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'username', 'email', 'phone', 'gender', 'password', 'isVerified', 'role', 'api_token'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
                  $user->profile()->create([
                    'users_id' => $user->id,
                ]);
                  $user->ratings()->create([
                'users_id' => $user->id,
            ]);
                redirect()->route('newapitoken');
                Mail::to($user->email)->send(new WelcomeMail());
            });

    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'users_id', 'id');
    }
    public function ratings()
    {
        return $this->hasOne(Ratings::class, 'users_id', 'id');
    }
    public function admin()
    {
        return $this->hasOne(Admin::class, 'users_id', 'id');
    }
    public function posts()
    {
    return $this->hasMany(posts::class, 'users_id', 'id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'users_id', 'id');
    }
    public function comments()
    {
        return $this->hasMany(comments::class, 'users_id', 'id');
    }
    public function message()
    {
        return $this->hasMany(message::class, 'users_id', 'id');
    }
    public function following()
    {
        return $this->belongsToMany(Profile::class, 'profiles', 'profile_id');
    }
    public function upvote()
    {
        return $this->hasMany(Upvote::class, 'users_id', 'id');
    }


}
