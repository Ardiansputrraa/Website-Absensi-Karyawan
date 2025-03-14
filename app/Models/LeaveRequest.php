<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;
    protected $table = 'leave_requests';
    protected $fillable = ['pegawai_id', 'leave_type', 'start_date', 'end_date', 'reason', 'status'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
