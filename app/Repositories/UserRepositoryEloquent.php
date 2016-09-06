<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserRepository;
use App\Models\User;

/**
 * Class UserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    
    public function store(array $input, $avatar){

        $attr['email'] = $input['email'];
        $attr['password'] = bcrypt($input['password']);
        $attr['name'] = $input['name'];

        if ($avatar != "") {
            $attr['user_pic'] = $avatar;
        }
        if (parent::create($attr)) {
            return true;
        }
        return false;
    }

    public function updateUser(array $input, $id, $avatar = '')
    {
        $attr['email'] = $input['email'];
        $attr['name'] = $input['name'];
        if ($input['password'] != "")  {
            $attr['password'] = bcrypt($input['password']);
        }
        if ($avatar != "") {
            $attr['user_pic'] = $avatar;
        }

        if (parent::update($attr, $id)) {
            return true;
        }
        return false;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
