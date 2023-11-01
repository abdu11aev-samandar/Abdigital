<?php

namespace App\Repositories;

use App\Events\Models\Post\PostCreated;
use App\Events\Models\Post\PostDeleted;
use App\Events\Models\Post\PostUpdated;
use App\Exceptions\GeneralJsonException;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostRepository extends BaseRepository
{
    public function create(array $attributes)
    {
        return DB::transaction(function () use ($attributes) {

            $created = Post::query()->create([
                'title' => data_get($attributes, 'title', 'Untitled'),
                'photo' => data_get($attributes, 'photo'),
                'body' => data_get($attributes, 'body'),
            ]);
            throw_if(!$created, GeneralJsonException::class, 'Failed to create. ');
            event(new PostCreated($created));
            if ($userIds = data_get($attributes, 'user_ids')) {
                $created->users()->sync($userIds);
            }
            return $created;
        });
    }

    public function update($post, array $attributes)
    {
        return DB::transaction(function () use ($post, $attributes) {
            $updated = $post->update([
                'title' => data_get($attributes, 'title', $post->title),
                'photo' => data_get($attributes, 'photo', $post->photo),
                'body' => data_get($attributes, 'body', $post->body),
            ]);

            throw_if(!$updated, GeneralJsonException::class, 'Failed to update post');

            event(new PostUpdated($post));

            if ($userIds = data_get($attributes, 'user_ids')) {
                $post->users()->sync($userIds);
            }

            return $post;

        });
    }

    public function forceDelete($post)
    {
        return DB::transaction(function () use ($post) {
            $deleted = $post->forceDelete();

            throw_if(!$deleted, GeneralJsonException::class, "Cannot delete post.");

            event(new PostDeleted($post));

            return $deleted;
        });
    }
}
