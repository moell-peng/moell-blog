<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\NavigationRepository;
use App\Models\Navigation;
use App\Validators\NavigationValidator;

/**
 * Class NavigationRepositoryEloquent
 * @package namespace App\Repositories;
 */
class NavigationRepositoryEloquent extends BaseRepository implements NavigationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Navigation::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
