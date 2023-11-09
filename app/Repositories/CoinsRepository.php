<?php

namespace App\Repositories;

use App\Models\Coins;

class CoinsRepository implements CoinsRepositoryInterface
{

    private Coins $model;

    function __construct(Coins $coins)
    {
        $this->model = $coins;
    }


    public function all($column = ['*'])
    {
        return $this->model::all($column);
    }

    public function find(int $id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function create(array $data)
    {
        $coin = $this->model->newInstance();
        $coin->title = $data['title'];
        $coin->symbol = $data['symbol'];

        $coin->save();

        return $coin->id;
    }

    public function delete(int $id)
    {
        $this->model->destroy($id);
    }

    public function update(array $data, int $id)
    {
        return $this->model->where('id', $id)->update($data);
    }
}
