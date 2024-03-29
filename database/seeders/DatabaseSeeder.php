<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run() {
        $this->call(CompanySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AllowedDomainsSeeder::class);
        $this->call(PostSeeder::class);
    }
}
