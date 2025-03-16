<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LokasiKantor extends Model {
    use HasFactory;

    protected $table = 'lokasi_kantors';
    protected $fillable = ['nama_kantor', 'alamat', 'latitude', 'longitude', 'radius'];

    public function attendances(): HasMany {
        return $this->hasMany(Attendance::class);
    }
}
