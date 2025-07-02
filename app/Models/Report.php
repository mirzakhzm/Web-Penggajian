<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';

    public $timestamps = false;

    protected $fillable = ['nama_file', 'jumlah_data', 'created_at'];
}
