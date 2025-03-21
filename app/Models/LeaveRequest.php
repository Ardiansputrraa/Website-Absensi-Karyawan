<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveRequest extends Model {
    use HasFactory;

    protected $table = 'leave_requests';
    protected $fillable = ['pegawai_id', 'name', 'leave_type', 'start_date', 'end_date', 'file', 'reason', 'status'];

    public function pegawai(): BelongsTo {
        return $this->belongsTo(Pegawai::class);
    }
}
