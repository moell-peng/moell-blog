<?php

namespace App\Services;

use App\Repositories\UserRepositoryEloquent;
use App\Repositories\CategoryRepositoryEloquent;
use App\Http\Request;

class ArticleService
{
    protected $user;
    protected $category;

    public function __construct(UserRepositoryEloquent $user, CategoryRepositoryEloquent $category)
    {
        $this->user = $user;
        $this->category = $category;
    }

    public function getArticleUserAndCategory($articles)
    {
        $cate_id    = [];
        $user_id    = [];
        foreach ($articles as $article) {
            $cate_id[] = $article->cate_id;
            $user_id[] = $article->user_id;
        }

        return [
            'category'  => $this->getCategoryIdName($cate_id),
            'user'      => $this->getUserIdName($user_id)
        ];
    }

    /**
     * @param array $user
     * @return array
     */
    protected function getUserIdName(array $user)
    {
        if (count($user) > 0) {
            $users = $this->user->findWhereIn('id', $user, ['id', 'name']);
            if ($users) {
                return $this->formatIdName($users->toArray());
            }
        }
        return [];
    }

    /**
     * @param array $category
     * @return array
     */
    protected function getCategoryIdName(array $category)
    {
        if (count($category) > 0) {
            $categories = $this->category->findWhereIn('id', $category, ['id', 'name']);
            if ($categories) {
                return $this->formatIdName($categories->toArray());
            }
        }
        return [];
    }

    /**
     * @param array $data
     * @return array
     */
    protected function formatIdName(array $data)
    {
        $new = [];
        foreach ($data as $d) {
            $new[$d['id']] = $d['name'];
        }
        return $new;
    }


    /**
     * 搜索where条件
     *
     * @param $request
     * @return array
     */
    public static function backendSearchWhere($request)
    {
        $where = [];
        if ($request->title != "") {
            $where[] = ['title', 'like', "%".$request->title."%"];
        }

        if ($request->cate_id > 0) {
            $where[] = ['cate_id', '=', $request->cate_id];
        }

        return $where;
    }
}