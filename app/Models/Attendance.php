<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendance';
    protected $fillable = ['pegawai_id', 'date', 'check_in', 'check_out', 'status'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
