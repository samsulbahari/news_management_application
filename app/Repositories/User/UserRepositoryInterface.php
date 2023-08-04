<?php
namespace App\Repositories\User;

Interface UserRepositoryInterface{
    public function getUserByEmail($email);
}