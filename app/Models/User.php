<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table = 'tbl_user';
    protected $allowedFields = ['username', 'email', 'password', 'remember_token'];

    public function updatePassword($id, $hashedPassword)
    {
        return $this->set('password', $hashedPassword)
            ->where('id', $id)
            ->update();
    }
}
?>