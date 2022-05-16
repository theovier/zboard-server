<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AllowedDomainFactory extends Factory {
    public function definition() {
        return [
            'name' => $this->faker->unique()->domainName(),
        ];
    }
}
