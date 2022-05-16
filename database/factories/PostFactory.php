<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory {

    public function definition() {
        return [
            'title' => $this->faker->jobTitle,
            'content' => $this->faker->realText(),
            'author_id' => User::inRandomOrder()->first()->id
        ];
    }
}
