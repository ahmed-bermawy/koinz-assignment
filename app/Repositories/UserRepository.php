<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getDetail(int $id)
    {
        return User::find($id);
    }
}
