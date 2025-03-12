<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\AuthorizationException;

class AdminPolicy
{
    public function viewData(User $user): bool
    {
        if ($user->role !== 'admin') {
            throw new AuthorizationException('Anda tidak memiliki hak akses untuk melihat halaman ini.');
        }
        return true;
    }

    public function viewDetailData(User $user): bool
    {
        if ($user->role !== 'admin') {
            throw new AuthorizationException('Anda tidak memiliki hak akses untuk melihat halaman ini.');
        }
        return true;
    }

    public function updateData(User $user): bool
    {
        if ($user->role !== 'admin') {
            throw new AuthorizationException('Anda tidak memiliki hak akses untuk mengupdate data.');
        }
        return true;
    }

    public function deleteData(User $user): bool
    {
        if ($user->role !== 'admin') {
            throw new AuthorizationException('Anda tidak memiliki hak akses untuk menghapus data.');
        }
        return true;
    }

    public function searchData(User $user): bool
    {
        if ($user->role !== 'admin') {
            throw new AuthorizationException('Anda tidak memiliki hak akses untuk mencari data.');
        }
        return true;
    }

    public function downloadData(User $user): bool
    {
        if ($user->role !== 'admin') {
            throw new AuthorizationException('Anda tidak memiliki hak akses untuk mendownload data.');
        }
        return true;
    }
}
