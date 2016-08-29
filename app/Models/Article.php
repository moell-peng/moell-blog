<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Article extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'articles';

    //protected $fillable = [];

    protected $guarded = ['id'];

    /**
     * 文章标签
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articleTag()
    {
        return $this->hasMany('App\Models\ArticleTag', 'article_id', 'id');
    }

    public function getStatusAttribute($value)
    {
        return $value == 1 ? '私密' : '公开';
    }

}
