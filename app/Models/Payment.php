<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'salary_id',
        'bukti_pembayaran',
        'tanggal_pembayaran',
        'status_pembayaran',
    ];

    public $timestamps = false; // Disable timestamps if not needed

    public function salary()
    {
        return $this->belongsTo(Salari::class, 'salary_id');
    }
}
