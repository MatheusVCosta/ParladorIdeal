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
     * 
     * @param $request with values to filter query
     * @api /api/posts/
     * @method GET
     */
    public function showPosts(Request $request)
    {
        $page    = $request->input('page', 1);
        $myPosts = $request->input('myPosts', false);
        $postId  = (int) $request->input('postId', 0);

        $currentUser = Auth::user();

        $posts = PostService::getPosts($currentUser->id, $myPosts, $postId);
        if (empty($posts)) {
            return self::success(options: [
                'message' => 'Nenhum publicação encontrada.'
            ]);
        }

        return self::success(options: ['data' => $posts->get()]);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param $request with the values to create a new post
     * @api /api/posts/
     * @method POST
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
     * 
     * @param $postId specified to search post
     * @api /api/posts/myPost/{postId}
     * @method GET
     */
    public function show(int $postId)
    {
        $currentUser = Auth::user();

        $posts = PostService::getMyPost($currentUser->id, $postId);
        if (empty($posts)) {
            return self::success(options: [
                'message' => 'Nenhum publicação encontrada.'
            ]);
        }

        return self::success(options: ['data' => $posts->first()]);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param $postId specified to search post
     * @param $request with values to updated
     * 
     * @api /api/posts/myPosts/{postId}
     * @method PUT
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
            'message' => 'Seu Post Foi Atualizado'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param $postId specified to search post and delete
     * @api /api/posts/myPosts/{postId}
     * @method DELETE
     */
    public function destroy(int $postId)
    {
        if (!PostService::deletePost($postId)) {
            return self::error(options: [
                'action' => 'delete'
            ]);
        }
        return self::success(options: [
            'message' => 'Post Deletado'
        ]);
    }

    // PRIVATE METHODS
    /**
     * Validate params informed in request
     * 
     * @param $request 
     * @param $rules 
     */
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
