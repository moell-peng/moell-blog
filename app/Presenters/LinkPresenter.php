<?php

namespace App\Presenters;

use App\Transformers\LinkTransformer;
use Prettus\Repository\Presenter\FractalPresenter;
use App\Repositories\LinkRepositoryEloquent;

/**
 * Class LinkPresenter
 *
 * @package namespace App\Presenters;
 */
class LinkPresenter extends FractalPresenter
{
    protected $link;

    public function __construct(LinkRepositoryEloquent $link)
    {
        $this->link = $link;
        parent::__construct();
    }

    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LinkTransformer();
    }

    /**
     * 获取友情链接
     *
     * @return mixed
     */
    public function linkList()
    {
        $links = $this->link->orderBy('sequence', 'desc')->all(['name','url']);
        return $links;
    }
}
