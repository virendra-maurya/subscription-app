<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['creator_id', 'website_id', 'title', 'description'];

    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }

    public function scopeNotNotified($query)
    {
        return $query->where('is_notified', 0);
    }



    public function getPostUrlAttribute()
    {
        return route('api.post.show', [$this->website, 'post' => $this]);
    }
}
