<?php

namespace App\Presenters;

use App\Transformers\ArticleTransformer;
use Prettus\Repository\Presenter\FractalPresenter;
use App\Repositories\ArticleRepositoryEloquent;

/**
 * Class ArticlePresenter
 *
 * @package namespace App\Presenters;
 */
class ArticlePresenter extends FractalPresenter
{
    protected $article;

    public function __construct(ArticleRepositoryEloquent $article)
    {
        $this->article = $article;
        parent::__construct();
    }

    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ArticleTransformer();
    }

    /**
     * 获取热门文章
     *
     * @return mixed
     */
    public function hotArticleList()
    {
        return $this->article
            ->orderBy('read_count', 'desc')
            ->paginate(8, [
                'id',
                'title',
                'read_count'
            ]);
    }

    public function formatTitle($title)
    {
        if (strlen($title) <= 20) {
            return $title;
        } else {
            return mb_substr($title, 0, 20, 'utf-8')."...";
        }
    }
}
