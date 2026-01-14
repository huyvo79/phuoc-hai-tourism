<?php
namespace App\Interfaces;

interface PostServiceInterface
{
    public function getAllPosts();
    public function getAllPostsWithoutPagination();
    public function getPostById($id);
    public function createPost(array $data);
    public function updatePost($id, array $data);
    public function deletePost($id);
}