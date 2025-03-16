<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Model {
    use HasFactory;

    protected $table = 'pegawais';
    protected $fillable = ['user_id', 'name', 'image', 'email', 'phone_number', 'position', 'role'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function leaveRequests() {
        return $this->hasMany(LeaveRequest::class);
    }

    public function attendance() {
        return $this->hasMany(Attendance::class);
    }
}

