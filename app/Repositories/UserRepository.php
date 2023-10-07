<?php

namespace App\Repositories;

use App\Models\User;
class UserRepository
{

 public function save($data){
    return User::create($data);
 }

}
