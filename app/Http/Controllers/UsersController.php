<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller as BaseController;

class UsersController extends BaseController
{
    public function get() {
        return User::all();
    }

    public function getUsersWithName(string $name) {
        $query = User::select();
        $results = User::filter($query, 'name', $name, '=')->get();
    }
}
