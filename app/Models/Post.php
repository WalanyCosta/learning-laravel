<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that a re mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'title',
    //     'slug',
    //     'content',
    //     'category',
    // ];

    protected $guarded = [
        'is_active'
    ];
    protected $table = 'posts';

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    protected function title(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => strtolower($value),
            get: function (string $value) {
                return ucfirst($value);
            }
        );
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}