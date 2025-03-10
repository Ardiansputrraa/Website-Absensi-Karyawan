<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = ['username', 'password', 'role'];

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function pegawai()
    {
        return $this->hasOne(Pegawai::class);
    }
}
