<?php

namespace Database\Seeders;

use App\Models\kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriData =
            [
                [
                    'kategori' => 'hardware'
                ],
                [
                    'kategori' => 'software'
                ],
                [
                    'kategori' => 'laptop'
                ],
                [
                    'kategori' => 'komputer'
                ]
            ];

        foreach ($kategoriData as $data) {
            kategori::create($data);
        }
    }
}
