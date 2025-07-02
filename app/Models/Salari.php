<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salari extends Model
{
    protected $table = 'salaris';

    protected $fillable = ['nama_karyawan', 'bulan', 'gaji_pokok', 'bonus', 'pajak', 'total_diterima', 'notes', 'tanggal_pengajuan'];

    public $timestamps = false;

    public function payment()
    {
        return $this->hasOne(Payment::class, 'salary_id');
    }
}
