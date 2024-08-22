<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Admin\Database\Factories\BlogFactory;

class Blog extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id',
        'title',
        'slug',
        'content',
        'attachment',
        'category_id',
        'tag'
    ];

    protected static function newFactory()
    {
        //return BlogFactory::new();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryBlog::class);
    }

    protected $casts = [
        'tag' => 'array'
    ];
}
