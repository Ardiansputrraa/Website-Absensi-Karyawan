<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model {
    use HasFactory;

    protected $table = 'attendances';
    protected $fillable = ['pegawai_id', 'date', 'check_in', 'check_out', 'status', 'kantor_id', 'latitude', 'longitude'];

    public function pegawai(): BelongsTo {
        return $this->belongsTo(Pegawai::class);
    }

    public function lokasiKantor(): BelongsTo {
        return $this->belongsTo(LokasiKantor::class, 'kantor_id');
    }
}

