<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface EntityTestRepository.
 *
 * @package namespace App\Repositories;
 */
interface EntityTestRepository extends RepositoryInterface
{

    public function get_morteza();

    public function create_id(array $data): Model;

}
