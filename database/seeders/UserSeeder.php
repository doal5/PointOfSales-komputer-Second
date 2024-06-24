<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userdata = [
            [
                'name' => 'sechan',
                'email' => 'sechan@gmail.com',
                'level' => 1,
                'password' => bcrypt(123456),
                'password_dekripsi' => 123456
            ],
            [
                'name' => 'sechan',
                'email' => 'sechan1@gmail.com',
                'level' => 1,
                'password' => bcrypt(123456),
                'password_dekripsi' => 123456
            ],
            [
                'name' => 'sechan',
                'email' => 'sechan2@gmail.com',
                'level' => 1,
                'password' => bcrypt(123456),
                'password_dekripsi' => 123456
            ],
            [
                'name' => 'sechan',
                'email' => 'sechan3@gmail.com',
                'level' => 1,
                'password' => bcrypt(123456),
                'password_dekripsi' => 123456
            ],
            [
                'name' => 'sechan',
                'email' => 'sechan4@gmail.com',
                'level' => 1,
                'password' => bcrypt(123456),
                'password_dekripsi' => 123456
            ],
        ];

        foreach ($userdata as $item) {
            User::create($item);
        }
    }
}
