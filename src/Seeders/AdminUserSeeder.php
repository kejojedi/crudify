<?php

namespace Kejojedi\Crudify\Seeders;

use App\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        factory(User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);
    }
}
