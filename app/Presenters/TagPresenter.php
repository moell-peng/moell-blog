<?php

namespace App\Presenters;

use App\Transformers\TagTransformer;
use Prettus\Repository\Presenter\FractalPresenter;
use App\Repositories\TagRepositoryEloquent;

/**
 * Class TagPresenter
 *
 * @package namespace App\Presenters;
 */
class TagPresenter extends FractalPresenter
{
    protected $tag;

    public function __construct(TagRepositoryEloquent $tag)
    {
        $this->tag = $tag;
        parent::__construct();
    }

    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TagTransformer();
    }

    /**
     * 获取以;分割的标签
     *
     * @param $idList
     * @return string
     */
    public function tagNameList($idList)
    {
        $tagName = '';
        if ($idList != "") {
            $tags = $this->tag->findWhereIn('id', explode(',', $idList), ['tag_name']);
            if ($tags) {
                foreach ($tags as $tag) {
                    $tagName .= $tag->tag_name.";";
                }
            }
        }
        return $tagName;
    }

    /**
     * 获取标签列表
     *
     * @return mixed
     */
    public function tagList()
    {
        return $this->tag->all(['id', 'tag_name']);
    }
}
