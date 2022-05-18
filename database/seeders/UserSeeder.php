<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
    public function run() {
        User::factory()->create([
            'name' => 'Justus Jonas',
            'company_id' => 1,
            'profile_picture_url' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?crop=entropy&cs=tinysrgb&fm=jpg&ixlib=rb-1.2.1&q=80&raw_url=true&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470'
        ]);

        User::factory()->create([
            'name' => 'Bob Andrews',
            'company_id' => 2,
            'profile_picture_url' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?crop=entropy&cs=tinysrgb&fm=jpg&ixlib=rb-1.2.1&q=80&raw_url=true&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687'
        ]);

        User::factory()->create([
            'name' => 'Peter Shaw',
            'company_id' => 3,
            'profile_picture_url' => 'https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=880&q=80'
        ]);

        User::factory()->create([
            'name' => 'Lucky Luke',
            'company_id' => 4,
            'profile_picture_url' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?crop=entropy&cs=tinysrgb&fm=jpg&ixlib=rb-1.2.1&q=80&raw_url=true&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=761'
        ]);

        User::factory()->create([
            'name' => 'Fred Feuerstein',
            'company_id' => 2,
            'profile_picture_url' => 'https://images.unsplash.com/photo-1517849845537-4d257902454a?crop=entropy&cs=tinysrgb&fm=jpg&ixlib=rb-1.2.1&q=80&raw_url=true&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=735'
        ]);

        User::factory()->create([
            'name' => 'Lassmiranda De Sivilia',
            'company_id' => 1,
            'profile_picture_url' => 'https://images.unsplash.com/photo-1502823403499-6ccfcf4fb453?crop=entropy&cs=tinysrgb&fm=jpg&ixlib=rb-1.2.1&q=80&raw_url=true&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1974'
        ]);

        User::factory()->create([
            'name' => 'Volker Putt',
            'company_id' => 5,
            'profile_picture_url' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&raw_url=true&q=80&fm=jpg&crop=entropy&cs=tinysrgb&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687'
        ]);

        User::factory(1)->create([
            'name' => 'root',
            'email' => "root@example.com",
            'company_id' => 3,
            'profile_picture_url' => 'https://images.unsplash.com/photo-1596796867443-48bb5d2ebaa0?crop=entropy&cs=tinysrgb&fm=jpg&ixlib=rb-1.2.1&q=80&raw_url=true&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=765'
        ]);
    }
}
