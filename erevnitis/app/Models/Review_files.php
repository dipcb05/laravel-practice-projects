<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Review_files extends Model
{
    protected $guarded = [];
    protected $fillable = ['reviews_id', 'summary_txt', 'summary_doc', 'algo_txt', 'algo_doc', 'full_reviews_txt', 'full_reviews_doc'];
    protected $table = "review_files";

    public function review()
    {
        return $this->belongsTo(Review::class, 'reviews_id', 'id');
    }
}
