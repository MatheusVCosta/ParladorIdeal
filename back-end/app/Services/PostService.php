<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Support\ItemNotFoundException;

class PostService
{

    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function convertArrToObject(array $postArray)
    {
        return $this->post->fill($postArray);
    }

    public function getAllPosts(int $userId = null)
    {
        $query = $this->post->query();
        
        if (!empty($userId)) {
            $query->where('user_id', $userId);
        }

        $query->with('user');
        $query->orderByDesc('created_at');
        if ($query->count() >= 1) {
            return $query;
        }

        return [];
        
    }

    public function createPost(Post $post, User $currentUser): Array
    {
        if (empty($post)) {
            throw new Exception("Error when create post");
        }

        $post->user()->associate($currentUser->id);
        $postSaved = $post->save();
        
        if (!$postSaved) {
            throw new Exception("Post not created");
        }

        return $post->only([
            'about_post',
            'created_at'
        ]);
    }

    public function updatePost(string $about_post, int $postId): bool
    {
        $post = $this->post->find($postId);
        if (empty($post)) {
            throw new ItemNotFoundException('Post not found. ID: ' . $postId);
        }

        $post->about_post = $about_post;
        $postUpdated = $post->update();

        if (!$postUpdated) {
            throw new Exception("Ocurred a error in update post!");
        }
        return $postUpdated;

    }

    public function deletePost(int $postId)
    {
        return $this->post->destroy($postId);
    }
}