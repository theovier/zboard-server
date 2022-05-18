<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
    public function run() {
        User::factory()->create([
            'name' => 'Justus Jonas',
            'company_id' => 1
        ]);

        User::factory()->create([
            'name' => 'Bob Andrews',
            'company_id' => 2
        ]);

        User::factory()->create([
            'name' => 'Peter Shaw',
            'company_id' => 3
        ]);

        User::factory()->create([
            'name' => 'Lucky Luke',
            'company_id' => 4
        ]);

        User::factory()->create([
            'name' => 'Fred Feuerstein',
            'company_id' => 2
        ]);

        User::factory()->create([
            'name' => 'Lassmiranda De Sivilia',
            'company_id' => 1
        ]);

        User::factory()->create([
            'name' => 'Volker Putt',
            'company_id' => 5
        ]);

        User::factory(1)->create([
            'name' => 'root',
            'email' => "root@example.com",
            'company_id' => 3
        ]);
    }
}
