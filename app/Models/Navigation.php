<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{

    protected $fillable = ['name','url','sequence','state', 'article_cate_id', 'nav_type'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'article_cate_id', 'id');
    }

}
