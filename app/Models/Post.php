<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'photo'
    ];

    protected $casts = [
        'body' => 'array'
    ];

    public function getTitleUpperCaseAttribute(): string
    {
        return strtoupper($this->title);
    }

    public function setTitleAttribute($value): void
    {
        $this->attributes['title'] = strtolower($value);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
