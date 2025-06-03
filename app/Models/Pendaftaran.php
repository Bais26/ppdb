<?php
// app/Models/Pendaftaran.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';

    protected $fillable = [
        'nomor_pendaftaran',
        'nama_santri',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_hp',
        'asal_sekolah',
        'nik',
        'nisn',
        'email',
        'nama_orangtua',
        'pekerjaan_orangtua',
        'no_hp_ortu',
        'alamat_ortu',

        'foto_sttb',
        'foto_skhun',
        'pas_foto',
        'foto_akta',
        'foto_nisn',
        'persetujuan',
        'status_pembayaran',
        'bukti_bayar',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'persetujuan' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->nomor_pendaftaran = self::generateNomorPendaftaran();
        });
    }

    public static function generateNomorPendaftaran()
    {
        $year = date('Y');
        $lastNumber = self::whereYear('created_at', $year)
                         ->count() + 1;
        
        return 'PS-' . $year . '-' . str_pad($lastNumber, 3, '0', STR_PAD_LEFT);
    }
}