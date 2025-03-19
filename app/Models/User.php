<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
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

