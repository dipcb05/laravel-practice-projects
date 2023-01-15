<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Edit extends Model
{
    protected $fillable = ['posts_id', 'reviews_id','summary', 'algo', 'sub', 'link', 'res', 'sum_percent', 'algo_percent', 'sub_percent', 'li_percent'];
    protected $table = "reviews_edit";
    public function reviews()
    {
        return $this->belongsTo(Review::class, 'reviews_id', 'id');
    }

}
