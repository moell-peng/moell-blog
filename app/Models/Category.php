<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Baum\Node;

class Category extends Node implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

    protected $table = 'categories';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function article()
    {
        return $this->hasOne('App\Models\Article', 'cate_id', 'id');
    }

}
