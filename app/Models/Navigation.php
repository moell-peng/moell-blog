<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Navigation extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['name','url','sequence','state', 'article_cate_id', 'nav_type'];

}
