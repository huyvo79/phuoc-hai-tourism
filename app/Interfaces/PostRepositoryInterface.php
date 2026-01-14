<?php
namespace App\Interfaces;
interface PostRepositoryInterface
{
    public function getAll();
    public function getAllWithoutPagination();
    public function find($id);
    public function create(array $attributes);
    public function update($id, array $attributes);
    public function delete($id);
    public function search($keyword, $limit = 5);
}