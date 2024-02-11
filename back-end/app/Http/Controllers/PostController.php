<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use PostService;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function myPosts(Request $request)
    {
        $page = $request->input('page', 1);

        $currentUser = Auth::user();
        $posts = PostService::getAllPosts($currentUser->id);
        if (empty($posts)) {
            return response()->json([
                'message' => 'Nothing to show now'
            ], 200);
        }

        return $posts->paginate(
            10,
            ['*'],
            'page',
            $page
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function showPosts()
    {
        
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
        return PostService::createPost($post, $currentUser);
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
            return response()->json([
                'type'    => "error",
                'message' => "Error in realize update!"
            ]);
        }

        return response()->json([
            'type'    => "success",
            'message' => "Success in update post"
        ]);;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $postId)
    {
        if (!PostService::deletePost($postId)) {
            return response()->json([
                'type'    => "error",
                'message' => "Error in delete post!"
            ]);
        }
        return response()->json([
            'type'    => "success",
            'message' => "Post delete with success"
        ]);;
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
