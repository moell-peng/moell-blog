<?php

namespace App\Presenters;

use App\Models\Article;
use App\Models\Tag;

/**
 * Class TagPresenter
 *
 * @package namespace App\Presenters;
 */
class TagPresenter
{
    public function tagNameList(Article $article)
    {
        $tag = $article->tag()->pluck('tag_name');
        
        return $tag ? implode(';', $tag->toArray()) : '';
    }

    /**
     * 获取标签列表
     *
     * @return mixed
     */
    public function tagList()
    {
        return Tag::query()->get(['id', 'tag_name']);
    }
}
