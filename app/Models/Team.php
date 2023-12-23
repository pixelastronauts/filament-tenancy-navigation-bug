<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($team) {
            $team->slug = Str::slug($team->name);
        });
    }
}
