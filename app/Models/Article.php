<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

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

    /**
     * article 与 tag 多对多关联
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tag()
    {
        return $this->belongsToMany('App\Models\Tag','article_tags', 'article_id', 'tag_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'cate_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }


}
