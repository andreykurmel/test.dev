<?php

namespace App\Repositories;

interface ProductInterface {
    public function create($data);

    public function update($id, $data);

    public function delete($id);

    public function getAll();

    public function getByUserId($id);

    public function getById($id);

    public function getByCode($code);

    public function getByName($name);
}