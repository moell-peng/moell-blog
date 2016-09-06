<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ArticleRepository;
use App\Models\Article;

/**
 * Class ArticleRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ArticleRepositoryEloquent extends BaseRepository implements ArticleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Article::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * 根据关键字搜索文章
     *
     * @param $keyword
     * @return mixed
     */
    public function searchKeywordArticle($keyword)
    {
        $search = "%".$keyword."%";
        $this->applyConditions([['title', 'like', $search]]);
        return $this->paginate(15, ['id','title','desc','user_id','cate_id','read_count','created_at']);
    }

    /**
     * 搜索文章
     *
     * @param array $where
     * @return mixed
     */
    public  function backendSearchArticle(array $where)
    {
        if (count($where) > 0) {
            $this->applyConditions($where);
        }

        return $this->orderBy('id', 'desc')->paginate(15);
    }
}
