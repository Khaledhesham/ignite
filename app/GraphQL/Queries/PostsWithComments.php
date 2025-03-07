<?php

namespace App\GraphQL\Queries;

use App\Models\Post;

class PostsWithComments
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        return Post::with('comments')->get();
    }
}
