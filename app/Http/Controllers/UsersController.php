<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Routing\Controller as BaseController;

class UsersController extends BaseController
{
    public function get() {
        return User::all();
    }

    public function getUsersWithName(string $name) {
        $user = new User();
        return $user->scopeFilter($user, 'name', $name, '=')->get();
    }

    public function getUsersWithProfile(Profile $profile) {
        $user = new User();
        return $user->scopeFilter($user, User::getTableName() . 'profile_id', $profile->id, 'in')->get();
    }

    public function getUsersWithEmailWord(string $word) {
        $user = new User();
        return $user->scopeFilter($user, 'email', $word, 'like')->get();
    }
}
