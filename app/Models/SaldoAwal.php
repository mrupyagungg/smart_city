<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SaldoAwal extends Model
{
    use HasFactory;

    protected $table = 'saldo_awal';

    protected $fillable = [
        'kode_saldo',
        'tanggal',
        'akun_id',
        'deskripsi',
        'jumlah',
        'posisi_db_cr'
    ];

    // Relasi ke tabel Akun
    public function akun()
    {
        return $this->belongsTo(Akun::class, 'akun_id');
    }

    /**
     * Generate kode saldo terbaru secara otomatis
     * Format: S-001, S-002, dst.
     *
     * @return string
     */
    public static function getKodeSaldo()
    {
        // Ambil kode saldo terakhir dengan mengurutkan berdasarkan angka
        $lastRecord = self::orderByRaw("CAST(SUBSTRING(kode_saldo, 3, LENGTH(kode_saldo)-2) AS UNSIGNED) DESC")
            ->first();

        // Jika belum ada data, mulai dari S-001
        if (!$lastRecord || !$lastRecord->kode_saldo) {
            return 'S-001';
        }

        // Ambil angka dari format S-001
        $lastNumber = (int) substr($lastRecord->kode_saldo, 2);

        // Tambah 1 untuk kode baru
        $newNumber = $lastNumber + 1;

        // Format kode baru dengan padding nol di depan
        return 'S-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }
}