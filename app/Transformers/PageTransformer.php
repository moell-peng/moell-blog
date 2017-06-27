<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Page;

/**
 * Class PageTransformer
 * @package namespace App\Transformers;
 */
class PageTransformer extends TransformerAbstract
{

    /**
     * Transform the \Page entity
     * @param \Page $model
     *
     * @return array
     */
    public function transform(Page $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
