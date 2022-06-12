<?php

namespace Database\Seeders;

use App\Models\AllowedDomain;
use Illuminate\Database\Seeder;

class AllowedDomainsSeeder extends Seeder {
    public function run() {
        AllowedDomain::factory(3)->create();
        AllowedDomain::factory()->create([
            'name' => "theovier.de"
        ]);
        AllowedDomain::factory()->create([
            'name' => "miele.de"
        ]);
        AllowedDomain::factory()->create([
            'name' => "uni-paderborn.de"
        ]);
        AllowedDomain::factory()->create([
            'name' => "upb.de"
        ]);
        AllowedDomain::factory()->create([
            'name' => "sn-invent.de"
        ]);
        AllowedDomain::factory()->create([
            'name' => "weidmueller.com"
        ]);
    }
}
