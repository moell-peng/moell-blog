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

}
