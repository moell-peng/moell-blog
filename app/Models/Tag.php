<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['tag_name', 'article_number'];

    protected $table = 'tags';

    /**
     * tag 与 article 多对多关联
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function article()
    {
        return $this->belongsToMany('App\Models\Article','article_tags', 'tag_id', 'article_id');
    }

}
