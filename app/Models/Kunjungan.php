<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    protected $table = 'kunjungan';

    protected $fillable = [
        'nim', 'nama', 'tanggal', 'waktu', 'metode',
        'kategori', 'instansi', 'keperluan', 'is_history'
    ];

    protected $casts = [
        'is_history' => 'boolean',
        'tanggal' => 'date',
    ];

    public function scopeToday($query)
    {
        $today = now()->setTimezone(config('app.timezone'))->toDateString();
        return $query->whereDate('tanggal', $today)->where(function($q){
            $q->whereNull('is_history')->orWhere('is_history', false);
        });
    }

    public function scopeHistory($query)
    {
        $today = now()->setTimezone(config('app.timezone'))->toDateString();
        return $query->where(function($q) use ($today) {
            $q->where('is_history', true)
              ->orWhereDate('tanggal', '<', $today);
        });
    }
}
