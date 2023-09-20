<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SatuansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('satuans')->insert([
            ['nama_satuan' => 'Pcs'],
            ['nama_satuan' => 'Gram'],
            ['nama_satuan' => 'Kilogram'],
            ['nama_satuan' => 'Kwintal'],
            ['nama_satuan' => 'Ton'],
        ]);
    }
}
