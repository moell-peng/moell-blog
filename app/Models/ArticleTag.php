<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{

    protected $fillable = ['article_id', 'tag_id'];

    public $timestamps = false;

}
