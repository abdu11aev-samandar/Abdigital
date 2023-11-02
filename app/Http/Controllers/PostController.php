<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index(Request $request)
    {
        $pageSize = $request->page_size ?? 20;

        $posts = Post::query()->paginate($pageSize);

        return PostResource::collection($posts);
    }

    public function store(StorePostRequest $request, PostRepository $repository)
    {
        $created = $repository->create($request->toArray());

        return $this->success('Discount created successfully', new PostResource($created));
    }


    public function show(Post $post)
    {
        return new PostResource($post);
    }


    public function update(UpdatePostRequest $request, Post $post, PostRepository $repository)
    {
        $post = $repository->update($post, $request->toArray());

        return $this->success('Post updated successfully', new PostResource($post));
    }


    public function destroy(Post $post, PostRepository $repository)
    {
        $post = $repository->forceDelete($post);

        return $this->success('Post deleted successfully');
    }

}
