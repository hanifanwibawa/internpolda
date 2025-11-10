<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(SatkersTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(AnggotasTableSeeder::class);
        $this->call(AbsensisTableSeeder::class);
        $this->call(Absen_detailsTableSeeder::class);
    }
}
