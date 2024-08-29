<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Admin\Database\Factories\GalleryFactory;

class Gallery extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id',
        'title',
        'image',
        'created_at',
        'updated_at'
    ];

    protected static function newFactory()
    {
        //return GalleryFactory::new();
    }
}
