<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ArticleTagRepository
 * @package namespace App\Repositories;
 */
interface ArticleTagRepository extends RepositoryInterface
{
    public function getModel();
}
