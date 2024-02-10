<?php

namespace App\Services;

use App\Models\Post;
use App\Services\CRUDService;

class PostService implements CRUDService
{

    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function convertArrToObject(array $array)
    {

    }

    public function getAllPosts()
    {

    }

    public function createPost()
    {

    }

    public function updatePost()
    {

    }

    public function deletePost()
    {

    }
}