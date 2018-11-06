<?php

namespace App\Presenters;

use App\Models\User;

/**
 * Class UserPresenter
 *
 * @package namespace App\Presenters;
 */
class UserPresenter
{
    public function getUserName($userId)
    {
        $user = User::where('id', $userId)->first();

        if ($user) {
            return $user->name;
        }
    }

    public function getUserInfo($userId = 0) {
        $columns = ['id', 'name', 'user_pic'];

        if ($userId > 0) {
            return User::where("id", $userId)->first($columns);
        }
        return User::first($columns);
    }
}
