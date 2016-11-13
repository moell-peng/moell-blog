<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CategoryRepository;
use App\Models\Category;
use App\Validators\CategoryValidator;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace App\Repositories;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    /**
     * @return mixed
     */
    public function getNestedList()
    {
        return $this->model->getNestedList('name', null, '&nbsp;&nbsp;&nbsp;&nbsp;');
    }

    /**
     * @param $input
     * @return bool
     */
    public function store($input)
    {
        if ($input['cate_id'] == 0) {
            return $this->model->create(['name' => $input['name']]) ? true : false;
        }

        $category = $this->model->find($input['cate_id']);
        if (!$category) {
            return false;
        }

        return $category->children()->create(['name' => $input['name']]) ? true : false;
    }

    /**
     * 分类修改
     *
     * @param array $attributes
     * @param $id
     * @return bool
     */
    public function update(array $attributes, $id)
    {
        $input['name'] = $attributes['name'];
        $parentId = $attributes['cate_id'];

        $category = $this->model->find($id);
        if (!$category) {
            return false;
        }

        if (!parent::update($input, $id)) {
            return false;
        }

        if ($parentId != 0 && $category->parent_id != $parentId) {

            $parentCategory = $this->model->find($parentId);
            if (!$parentCategory) {
                return false;
            }

            if (!$category->makeChildOf($parentCategory)) {
                return false;
            }
        } elseif ($category->parent_id != $parentId && $parentId == 0) {
            //顶级分类
            if (!$category->makeRoot()) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        $this->applyCriteria();
        $this->applyScope();
        $model = $this->model->find($id, $columns);
        $this->resetModel();

        return $this->parserResult($model);
    }

    public function baseFind($id, $columns = ['*'])
    {
        return parent::find($id, $columns);
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
