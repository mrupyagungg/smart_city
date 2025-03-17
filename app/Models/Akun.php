<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    use HasFactory;

    protected $table = 'akun';

    // Kolom yang bisa diisi (mass assignment)
    protected $fillable = [
        'kode_akun',
        'nama_akun',
        'header_akun',
        'db_cr',
    ];

    /**
     * Generate kode akun terbaru secara otomatis
     * Format: KA-001, KA-002, dst.
     *
     * @return string
     */
    public static function getKodeAkun()
    {
        // Ambil kode akun terbesar yang ada di database
        $lastKode = self::max('kode_akun');

        // Jika belum ada data, mulai dari KA-001
        if (!$lastKode) {
            return 'KA-001';
        }

        // Ambil angka dari format KA-001
        $lastNumber = (int) substr($lastKode, -3);

        // Tambah 1 untuk kode baru
        $newNumber = $lastNumber + 1;

        // Format kode baru dengan padding nol di depan
        return 'KA-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }
}