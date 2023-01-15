<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Builder create(array $attributes = [])
 * @method public Builder update(array $values)
 */
class Admin extends Model
{
    protected $fillable = [
        'users_id', 'username', 'office_id', 'position', 'joining_date'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
