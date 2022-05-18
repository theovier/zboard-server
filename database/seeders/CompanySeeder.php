<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder {
    public function run() {
        Company::factory()->create([
            'name' => 'Universität Paderborn'
        ]);
        Company::factory()->create([
            'name' => 'Miele'
        ]);
        Company::factory()->create([
            'name' => 'S&N'
        ]);
        Company::factory()->create([
            'name' => 'Fraunhofer'
        ]);
    }
}
