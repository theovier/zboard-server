<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class CompanyFactory extends Factory {

    public function definition() {
        return [
            'name' => $this->faker->company(),
        ];
    }
}
