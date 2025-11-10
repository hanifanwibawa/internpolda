<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SatkersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('satkers')->insert([
            ['satker_id' => 1, 'satker_name' => 'ITWASDA', 'satker_position' => 'SELATAN'],
            ['satker_id' => 2, 'satker_name' => 'BIRO OPS', 'satker_position' => 'SELATAN'],
            ['satker_id' => 3, 'satker_name' => 'BIRO RENA', 'satker_position' => 'SELATAN'],
            ['satker_id' => 4, 'satker_name' => 'BIRO SDM', 'satker_position' => 'SELATAN'],
            ['satker_id' => 5, 'satker_name' => 'BIROLOG', 'satker_position' => 'SELATAN'],
            ['satker_id' => 6, 'satker_name' => 'SATBRIMOB', 'satker_position' => 'GEDUNG UTAMA'],
            ['satker_id' => 7, 'satker_name' => 'DITSAMAPTA', 'satker_position' => 'GEDUNG UTAMA'],
            ['satker_id' => 8, 'satker_name' => 'DITPOLAIRUD', 'satker_position' => 'GEDUNG UTAMA'],
            ['satker_id' => 9, 'satker_name' => 'DITPAMOBVIT', 'satker_position' => 'GEDUNG UTAMA'],
            ['satker_id' => 10, 'satker_name' => 'DITLANTAS', 'satker_position' => 'GEDUNG UTAMA'],
            ['satker_id' => 11, 'satker_name' => 'DITBINMAS', 'satker_position' => 'GEDUNG UTAMA'],
            ['satker_id' => 12, 'satker_name' => 'DITINTELKAM', 'satker_position' => 'GEDUNG UTAMA'],
            ['satker_id' => 13, 'satker_name' => 'DITRESKRIMUM', 'satker_position' => 'GEDUNG UTAMA'],
            ['satker_id' => 14, 'satker_name' => 'DITRESKRIMSUS', 'satker_position' => 'GEDUNG UTAMA'],
            ['satker_id' => 15, 'satker_name' => 'DITRESNARKOBA', 'satker_position' => 'GEDUNG UTAMA'],
            ['satker_id' => 16, 'satker_name' => 'BIDLABFOR', 'satker_position' => 'GEDUNG UTAMA'],
            ['satker_id' => 17, 'satker_name' => 'DITTAHTI', 'satker_position' => 'GEDUNG UTAMA'],
            ['satker_id' => 18, 'satker_name' => 'BIDPROPAM', 'satker_position' => 'GEDUNG UTAMA'],
            ['satker_id' => 19, 'satker_name' => 'BIDHUMAS', 'satker_position' => 'GEDUNG UTAMA'],
            ['satker_id' => 20, 'satker_name' => 'BIDKUM', 'satker_position' => 'GEDUNG UTAMA'],
            ['satker_id' => 21, 'satker_name' => 'BID TIK', 'satker_position' => 'GEDUNG UTAMA'],
            ['satker_id' => 22, 'satker_name' => 'BIDKEU', 'satker_position' => 'GEDUNG UTAMA'],
            ['satker_id' => 23, 'satker_name' => 'BIDDOKKES', 'satker_position' => 'UTARA'],
            ['satker_id' => 24, 'satker_name' => 'RUMKIT', 'satker_position' => 'UTARA'],
            ['satker_id' => 25, 'satker_name' => 'SETUM', 'satker_position' => 'UTARA'],
            ['satker_id' => 26, 'satker_name' => 'YANMA', 'satker_position' => 'UTARA'],
            ['satker_id' => 27, 'satker_name' => 'SPKT', 'satker_position' => 'UTARA'],
        ]);
    }
}
