<?php

namespace App\Models;

use Baum\Node;

class Category extends Node
{
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
