<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory {

    public function definition() {
        return [
            'author_id' => User::inRandomOrder()->first(),
            'content' => $this->faker->realText(),
            'post_id' => Post::inRandomOrder()->first()
        ];
    }
}
