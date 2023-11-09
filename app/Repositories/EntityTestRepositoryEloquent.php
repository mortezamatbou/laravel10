<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EntityTestRepository;
use App\Entities\EntityTest;
use App\Validators\EntityTestValidator;

/**
 * Class EntityTestRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EntityTestRepositoryEloquent extends BaseRepository implements EntityTestRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EntityTest::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {
        return EntityTestValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function get_morteza()
    {
        return $this->model->where('id', 1)->first();
    }

    public function create_id(array $data): Model
    {
        $entity = $this->model->newInstance();
        $entity->firstName = $data['firstName'];
        $entity->lastName = $data['lastName'];
        $entity->age = $data['age'];
        $entity->field = $data['field'];

        $entity->save();
        return $entity;
    }

}
