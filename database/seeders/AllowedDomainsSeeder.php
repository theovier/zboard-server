<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AllowedDomainsSeeder extends Seeder {
    public function run() {
        DB::table('allowed_domains')->insert([
            ['name' => 'theovier.de'],
            ['name' => 'example.com']
        ]);
    }
}
