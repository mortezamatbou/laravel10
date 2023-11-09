<?php

namespace App\Repositories;

interface CoinsRepositoryInterface
{

    public function all();

    public function find(int $id);

    public function create(array $data);

    public function delete(int $id);

    public function update(array $data, int $id);

}
