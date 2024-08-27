<?php

namespace Modules\Admin\Models\CmsModels;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Admin\Database\Factories\GalleryCmsFactory;

class GalleryCms extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id',
        'title',
        'description'
    ];

    protected static function newFactory()
    {
        //return GalleryCmsFactory::new();
    }
}
