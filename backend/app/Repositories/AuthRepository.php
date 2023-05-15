<?php

namespace App\Repositories;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AuthRepository 
{
    
    public function getUser($id)
    {
        return User::findOrFail($id);
    }

    public function createUser($input) {
        
        return $user = User::create($input);
    }

}
