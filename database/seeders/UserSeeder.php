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
                'password' => bcrypt(123456)
            ],
            [
                'name' => 'aldo',
                'email' => 'aldo@gmail.com',
                'level' => 2,
                'password' => bcrypt(123456)
            ]
        ];

        foreach ($userdata as $item) {
            User::create($item);
        }
    }
}
