<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Response\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use PostService;

class PostController extends Controller
{
    use Response;
    /**
     * Display a listing of the resource.
     */
    public function showPosts(Request $request)
    {
        $page = $request->input('page', 1);
        $myPosts = $request->input('myPosts', false);
        $currentUser = Auth::user();

        $posts = PostService::getAllPosts($currentUser->id, $myPosts);
        if (empty($posts)) {
            return self::success(options: [
                'message' => 'Nenhum publicação encontrada.'
            ]);
        }

        return self::paginate($posts, $page);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $currentUser = Auth::user();

        $params = $this->_validateRequest($request, [
            'about_post' => 'required|string|max:280'
        ]);
        
        $post = PostService::convertArrToObject($params);
        if (!PostService::createPost($post, $currentUser)) {
            return self::error(options: [
                'action' => 'store'
            ]);
        }
        
        return self::success(options: [
            'message' => 'Post publicado em sua home.'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $postId)
    {
        $this->_validateRequest($request, [
            'about_post' => 'string|max:280'
        ]);

        $postUpdated = PostService::updatePost($request->about_post, $postId);
        if (!$postUpdated) {
            return self::error(options: [
                'action' => 'update'
            ]);
        }

        return self::success(options: [
            'message' => 'Post updated with success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $postId)
    {
        if (!PostService::deletePost($postId)) {
            return self::error(options: [
                'action' => 'delete'
            ]);
        }
        return self::success(options: [
            'message' => 'Post deleted with success'
        ]);
    }

    // PRIVATE METHODS

    private function _validateRequest(Request $request, Array $rules)
    {
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            throw ValidationException::withMessages([
                'messages' => [
                    $validator->errors()
                ]
            ]);
        }

        return $request->all();
    }
}
