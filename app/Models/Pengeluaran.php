<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $table = 'pengeluaran'; // Nama tabel di database

    protected $fillable = [
        'kode_pengeluaran',
        'tanggal',
        'akun_id',
        'deskripsi',
        'foto',
        'kredit',
        'jumlah',
    ];

    /**
     * Relasi ke tabel Akun
     * Setiap pengeluaran berhubungan dengan satu akun.
     */
    public function akun()
    {
        return $this->belongsTo(Akun::class, 'akun_id');
    }

    /**
     * Fungsi untuk generate kode pengeluaran otomatis (PG-001, PG-002, dst.)
     */
    public static function generateKodePengeluaran()
    {
        $lastPengeluaran = self::latest()->first();

        if ($lastPengeluaran) {
            $lastCode = intval(substr($lastPengeluaran->kode_pengeluaran, 3)); // Ambil angka setelah "PG-"
            $nextCode = $lastCode + 1;
        } else {
            $nextCode = 1;
        }

        return 'PG-' . str_pad($nextCode, 3, '0', STR_PAD_LEFT);
    }
}