<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;

    protected $table = 'kunjungan';

    protected $fillable = [
        'nim',
        'nama',
        'tanggal',
        'waktu',
        'metode',
    ];

    public $timestamps = true;

    // --- added: numeric enum mapping & casts ---
    public const METODE_RFID = 0;
    public const METODE_QR    = 1;
    public const METODE_MANUAL= 2;

    protected $casts = [
        'metode' => 'integer',
    ];

    public function setMetodeAttribute($value): void
    {
        if (is_string($value)) {
            $v = strtolower($value);
            $map = [
                'rfid'   => self::METODE_RFID,
                'qr'     => self::METODE_QR,
                'manual' => self::METODE_MANUAL,
            ];
            $this->attributes['metode'] = $map[$v] ?? (int) $value;
        } else {
            $this->attributes['metode'] = (int) $value;
        }
    }

    public function getMetodeLabelAttribute(): string
    {
        return match ($this->metode) {
            self::METODE_RFID => 'RFID',
            self::METODE_QR => 'QR',
            self::METODE_MANUAL => 'Manual',
            default => (string)$this->metode,
        };
    }
}
