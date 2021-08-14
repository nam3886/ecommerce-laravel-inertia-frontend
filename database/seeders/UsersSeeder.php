<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      =>  'Super Admin',
            'email'     =>  'admin@gmail.com',
            'password'  =>  bcrypt('123456'),
            'phone'     =>  '0973366072',
            'birthday'  =>  now(),
        ]);

        User::create([
            'name'      =>  'Nguyễn Văn An',
            'email'     =>  'nphuongnam8@gmail.com',
            'password'  =>  bcrypt('123456'),
            'phone'     =>  '0987654324',
            'birthday'  =>  now(),
        ]);

        User::create([
            'name'      =>  'Nguyễn Văn B',
            'email'     =>  'test1@truemark.cus',
            'password'  =>  bcrypt('123456'),
            'phone'     =>  '0909594444',
            'birthday'  =>  now(),
        ]);

        User::create([
            'name'      =>  'Nguyễn Văn C',
            'email'     =>  'test2@truemark.cus',
            'password'  =>  bcrypt('123456'),
            'phone'     =>  '0909495555',
            'birthday'  =>  now(),
        ]);
    }
}
