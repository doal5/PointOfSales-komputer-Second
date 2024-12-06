<?php

namespace Database\Seeders;

use App\Models\supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $supplierData =
            [
                [
                    'nama' => 'Komputer Jaya',
                    'email' => 'jaya@gmail.com',
                    'no_telepon' => '08927162637',
                    'alamat' => 'jl. Pamulang Raya',
                ],
                [
                    'nama' => 'Komputer hardware',
                    'email' => 'hardware@gmail.com',
                    'no_telepon' => '08927162635',
                    'alamat' => 'jl. Pamulang harware',
                ],
                [
                    'nama' => 'Komputer software',
                    'email' => 'software@gmail.com',
                    'no_telepon' => '08927162631',
                    'alamat' => 'jl. Pamulang software',
                ],

            ];

        foreach ($supplierData as $data) {
            supplier::create($data);
        }
    }
}
