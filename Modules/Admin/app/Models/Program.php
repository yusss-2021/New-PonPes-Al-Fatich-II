<?php

namespace Modules\Admin\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id',
        'title',
        'description',
        'image',
        'ended_at',
        'featured'
    ];

    protected static function newFactory()
    {
        //return ProgramFactory::new();
    }

    public function enddate()
    {
        Carbon::setLocale('id');
        $tanggal = Carbon::parse($this->ended_at);
        if ($tanggal->greaterThanOrEqualTo(Carbon::now())) {
            $sisaHari = Carbon::now()->diffForHumans($tanggal, ['days'], false, 2);
            $clean = str_replace(' sebelumnya', ' lagi', $sisaHari);
            $html = <<<HTML
                    <span class="badge bg-primary">Berakhir Dalam: $clean</span> 
                    HTML;
            return $html;
        } else {
            $html = <<<HTML
                    <span class="badge bg-danger">Program Sudah Berakhir</span>
                    HTML;
            return $html;
        }
    }
}
