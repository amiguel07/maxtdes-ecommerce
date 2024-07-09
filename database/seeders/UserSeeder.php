<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'admin']);
        User::create([
            'name' => 'Admin Istrador',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),

            'nid' => '12345678',
            'address' => 'En algún lado #4444',
            'cellular' => '123456789',

        ])->assignRole('admin');

        User::factory(20)->create();
    }
}
