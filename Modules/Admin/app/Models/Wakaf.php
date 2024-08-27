<?php

namespace Modules\Admin\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Number;
use Modules\Admin\Database\Factories\WakafFactory;

class Wakaf extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id',
        'title',
        'description',
        'target_amount',
        'raised_amount',
        'image',
        'end_date'
    ];

    protected static function newFactory()
    {
        //return WakafFactory::new();
    }

    public function getTargetAmount()
    {
        return Number::currency($this->target_amount, in: 'IDR', locale: 'id');
    }

    public function getRaisedAmount()
    {
        if ($this->raised_amount !== null) {
            $result = Number::currency($this->raised_amount, in: 'IDR', locale: 'id');
        } else {
            $result = 'Rp.0';
        }
        return $result;
    }

    public function getAvgAmount()
    {
        $raised = $this->raised_amount;
        $target = $this->target_amount;
        $result = ($raised / $target) * 100;
        if ($result >= 100) {
            $result = 100;
        }
        return $result;
    }

    public function getEndDate()
    {
        Carbon::setLocale('id');
        $tanggal = Carbon::parse($this->end_date);
        if ($tanggal->greaterThanOrEqualTo(Carbon::now())) {
            $sisaHari = Carbon::now()->diffForHumans($tanggal, ['days'], false, 2);
            $clean = str_replace(' sebelumnya', ' lagi', $sisaHari);
            $html = <<<HTML
                    <span class="badge bg-primary mb-1">Sisa: $clean</span> 
                    HTML;
            return $html;
        } else {
            $html = <<<HTML
                    <span class="badge bg-danger">Wakaf Sudah Berakhir</span>
                    HTML;
            return $html;
        }
    }

    public function getLastDays()
    {
        Carbon::setLocale('id');
        $tanggal = Carbon::parse($this->end_date);
        if ($tanggal->greaterThanOrEqualTo(Carbon::now())) {
            $sisaHari = Carbon::now()->diffForHumans($tanggal, ['days'], false, 2);
            $clean = str_replace(' sebelumnya', ' lagi', $sisaHari);
            $html = <<<HTML
                      <span class="float-end fs-6 fw-bold"> $clean</span>
                    HTML;
            return $html;
        } else {
            $html = <<<HTML
                    <span class="badge bg-danger">Wakaf Sudah Berakhir</span>
                    HTML;
            return $html;
        }
    }
}
