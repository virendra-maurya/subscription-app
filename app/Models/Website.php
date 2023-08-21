<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Website extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'is_active'];

    public function getRouteKeyName(): string
    {
        return 'sub_domain';
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function subscribedUsers()
    {
        return $this->belongsToMany(User::class, 'subscriptions', 'website_id', 'user_id');
    }
}
