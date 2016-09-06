<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\ArticleTag;

/**
 * Class ArticleTagTransformer
 * @package namespace App\Transformers;
 */
class ArticleTagTransformer extends TransformerAbstract
{

    /**
     * Transform the \ArticleTag entity
     * @param \ArticleTag $model
     *
     * @return array
     */
    public function transform(ArticleTag $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
