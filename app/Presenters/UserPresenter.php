<?php

namespace App\Presenters;

use App\Transformers\UserTransformer;
use Prettus\Repository\Presenter\FractalPresenter;
use App\Repositories\UserRepositoryEloquent;

/**
 * Class UserPresenter
 *
 * @package namespace App\Presenters;
 */
class UserPresenter extends FractalPresenter
{
    protected $user;

    public function __construct(UserRepositoryEloquent $user)
    {
        $this->user = $user;
        parent::__construct();
    }

    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new UserTransformer();
    }

    public function getUserName($userId)
    {
        $user = $this->user->find($userId, ['name']);
        if ($user) {
            return $user->name;
        }
    }

    public function getUserInfo($userId = 0) {
        $columns = ['id', 'name', 'user_pic'];

        if ($userId > 0) {
            return $this->user->find($userId, $columns);
        }
        return $this->user->first($columns);

    }
}
