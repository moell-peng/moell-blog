<?php

namespace App\Presenters;

use App\Models\ArticleTag;

/**
 * Class ArticleTagPresenter
 *
 * @package namespace App\Presenters;
 */
class ArticleTagPresenter
{

    public function getArticleNumber($tagId)
    {
        return ArticleTag::query()->where('tag_id', $tagId)->count();
    }
}
