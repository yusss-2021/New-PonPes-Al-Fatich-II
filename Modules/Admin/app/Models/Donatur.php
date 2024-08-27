<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Admin\Database\Factories\DonaturFactory;

class Donatur extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'address',
        'wakaf_id',
        'payment_id',
        'show_hamba_allah',
    ];

    protected static function newFactory()
    {
        //return DonaturFactory::new();
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }
}
