<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\Website;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request, Website $website)
    {
        \DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['creator_id'] = $request->user_id;

            $post = $website->posts()->create($data);

            \DB::commit();

            return response()->json([
                'message' => 'Your post has been created successfully!',
                'post' => $post->load('website'),
            ]);
        }catch (\Exception $e){
            \DB::rollBack();
            throw new \Error($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Website $website, Post $post)
    {
        return [
            'post' => $post,
            'website' => $website,
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
