<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryBlog extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id',
        'title',
    ];

    protected static function newFactory()
    {
        //return CategoryBlogFactory::new();
    }

    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class, 'category_id');
    }
}
