<?php

namespace App\Presenters;

use App\Transformers\ArticleTagTransformer;
use Prettus\Repository\Presenter\FractalPresenter;
use App\Repositories\ArticleTagRepositoryEloquent;

/**
 * Class ArticleTagPresenter
 *
 * @package namespace App\Presenters;
 */
class ArticleTagPresenter extends FractalPresenter
{
    protected $articleTag;

    public function __construct(ArticleTagRepositoryEloquent $articleTag)
    {
        $this->articleTag = $articleTag;
        parent::__construct();
    }
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ArticleTagTransformer();
    }

    public function getArticleNumber($tagId)
    {
        return $this->articleTag->getModel()->where('tag_id', $tagId)->count();
    }
}
