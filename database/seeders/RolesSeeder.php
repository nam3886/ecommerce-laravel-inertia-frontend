<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user               =   Role::create([
            'name'              =>  'User',
            'slug'              =>  'user',
            'permissions'       =>  [
                'read'          =>  true,
            ],
            'updated_by'        =>  1,
        ]);

        $admin                  = Role::create([
            'name'              =>  'Administrator',
            'slug'              =>  'admin',
            'permissions'       =>  [
                'root'          =>  true,
            ],
            'updated_by'        =>  1,
        ]);

        $admin->users()->attach([1]);
        $user->users()->attach([2, 3]);
    }
}
