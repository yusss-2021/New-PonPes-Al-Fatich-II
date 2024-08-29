<?php

namespace Modules\Admin\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Number;
use Modules\Admin\Database\Factories\PaymentFactory;

class Payment extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id',
        'transaction_id',
        'amount',
        'status',
    ];

    protected static function newFactory()
    {
        //return PaymentFactory::new();
    }

    public function getAmountRupiah()
    {
        return Number::currency($this->amount, in: 'IDR', locale: 'id');
    }

    public function donatur(): BelongsTo
    {
        return $this->belongsTo(Donatur::class);
    }

    public function getCreatedAt()
    {
        Carbon::setLocale('id');
        return Carbon::parse($this->created_at)->format('d F Y H:i:s');
    }
}
