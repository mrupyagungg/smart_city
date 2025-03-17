<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff';

    // Daftar kolom yang bisa diisi (mass assignment)
    protected $fillable = [
        'kode_staff',
        'nama_staff',
        'jenis_kelamin',
        'alamat',
        'no_telepon',
        'email_staff',
        'kategori_staff'
    ];

    /**
     * Generate kode staff terbaru secara otomatis
     * Format: Stf-001, Stf-002, dst.
     *
     * @return string
     */
    public static function getKodeStaff()
    {
        // Ambil kode staff terbesar yang ada di database
        $lastKode = self::max('kode_staff');

        // Jika belum ada data, mulai dari Stf-001
        if (!$lastKode) {
            return 'Stf-001';
        }

        // Ambil angka dari format Stf-001
        $lastNumber = (int) substr($lastKode, -3);

        // Tambah 1 untuk kode baru
        $newNumber = $lastNumber + 1;

        // Format kode baru dengan padding nol di depan
        return 'Stf-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }
}