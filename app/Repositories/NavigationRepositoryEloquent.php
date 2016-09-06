<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\NavigationRepository;
use App\Models\Navigation;

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

    /**
     * 设置分类为导航
     *
     * @param $categoryId
     * @param $categoryName
     * @return bool
     */
    public function setCategoryNav($categoryId, $categoryName)
    {
        $where = [
            ['article_cate_id', '=', $categoryId],
            ['nav_type', '=', 1]
        ];
        $navigation = $this->findWhere($where);
        if (!$navigation->isEmpty()) {
            return true;
        }

        $create['article_cate_id']  = $categoryId;
        $create['nav_type']     = 1;
        $create['name']         = $categoryName;
        $create['url']          = route('category', ['id' => $categoryId]);
        if ($this->create($create)) {
            return true;
        }

        return false;
    }
}
