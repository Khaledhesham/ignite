<?php

namespace App\GraphQL\Mutations;

use App\Models\Post;

class CreateMyPost
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $post = Post::create(
            [
                "description" => $args["description"],
                "user_id" => auth()->user()->id
            ]
        );

        return $post;
    }
}
