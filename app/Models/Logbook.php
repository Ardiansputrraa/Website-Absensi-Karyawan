<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Logbook extends Model
{
    use HasFactory;

    protected $table = 'logbook';
    protected $fillable = ['pegawai_id', 'name', 'jabatan', 'date', 'file', 'deskripsi'];

    public function pegawai(): BelongsTo {
        return $this->belongsTo(Pegawai::class);
    }
}
