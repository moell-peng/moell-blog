<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Navigation;

/**
 * Class NavigationTransformer
 * @package namespace App\Transformers;
 */
class NavigationTransformer extends TransformerAbstract
{

    /**
     * Transform the \Navigation entity
     * @param \Navigation $model
     *
     * @return array
     */
    public function transform(Navigation $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
