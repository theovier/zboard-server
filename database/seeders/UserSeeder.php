<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
    public function run() {
        User::factory(10)->create();
        User::factory(1)->create([
           'email' => "admin@example.com"
        ]);
    }
}
