<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table = 'tbl_user';
    protected $allowedFields = ['username', 'email', 'password'];

}
?>