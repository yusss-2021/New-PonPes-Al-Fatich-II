<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Number;

class Donasi extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id',
        'title',
        'description',
        'raised_amount',
        'image',
    ];

    protected static function newFactory()
    {
        //return DonasiFactory::new();
    }

    public function formatRupiah()
    {
        return $this->raised_amount !== null ? Number::currency($this->raised_amount, in: 'IDR', locale: 'id') : 'Rp.0';
    }
}
