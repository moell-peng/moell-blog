<?php

namespace App\Services;

use App\Repositories\TagRepositoryEloquent;
use App\Repositories\ArticleTagRepositoryEloquent;


class ArticleTagService
{
    protected $tags;

    protected $aricleTags;

    public function __construct(TagRepositoryEloquent $tag, ArticleTagRepositoryEloquent $articleTag)
    {
        $this->aricleTags = $articleTag;
        $this->tags = $tag;
    }

    /**
     * 写入文章标签
     *
     * @param $articleId
     * @param $tagNameString
     * @return bool
     */
    public function store($articleId, $tagNameString)
    {
        if ($tagNameString == "") {
            return false;
        }

        $tagNameList = array_unique(explode(';', trim($tagNameString, ';')));
        if (!$tagNameList) {
            return false;
        }

        foreach ($tagNameList as $tagName) {
            $tagData = $this->tags->findName($tagName);
            $create = [];
            $create['tag_id'] = count($tagData) > 0
                ? $tagData['id']
                : $this->tags->create(['tag_name' => $tagName])->id;
            $create['article_id'] = $articleId;
            $this->aricleTags->create($create);
        }
        return true;
    }

    /**
     * 编辑文章标签
     *
     * @param $articleId
     * @param $tagNameString
     * @return bool
     */
    public function updateArticleTags($articleId, $tagNameString)
    {
        //$this->aricleTags->deleteWhere(['article_id' => $articleId]);
        $this->aricleTags->getModel()->where('article_id', $articleId)->delete();
        return $this->store($articleId, $tagNameString);
    }

    /**
     * 获取文章标签ID
     *
     * @param array $tags
     * @param bool $type
     * @return array|string
     */
    public function tagsIdList($tags, $type = true)
    {
        $tagIdList = [];
        foreach ($tags as $tag) {
            $tagIdList[] = $tag->tag_id;
        }

        return $type ? $tagIdList : implode(',', $tagIdList);
    }
}