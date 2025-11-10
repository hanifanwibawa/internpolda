<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['user_id' => 1, 'satker_id' => 1, 'user_name' => 'ADMIN ITWASDA', 'user_password' => Hash::make('123'), 'user_role' => 'ADMIN_SATKER'],
            ['user_id' => 2, 'satker_id' => 2, 'user_name' => 'ADMIN BIRO OPS', 'user_password' => Hash::make('123'), 'user_role' => 'ADMIN_SATKER'],
            ['user_id' => 3, 'satker_id' => 3, 'user_name' => 'ADMIN BIRO RENA', 'user_password' => Hash::make('123'), 'user_role' => 'ADMIN_SATKER'],
            ['user_id' => 4, 'satker_id' => 4, 'user_name' => 'ADMIN BIRO SDM', 'user_password' => Hash::make('123'), 'user_role' => 'ADMIN_SATKER'],
            ['user_id' => 5, 'satker_id' => 5, 'user_name' => 'ADMIN BIROLOG', 'user_password' => Hash::make('123'), 'user_role' => 'ADMIN_SATKER'],
            ['user_id' => 6, 'satker_id' => 6, 'user_name' => 'ADMIN SATBRIMOB', 'user_password' => Hash::make('123'), 'user_role' => 'ADMIN_SATKER'],
            ['user_id' => 7, 'satker_id' => 7, 'user_name' => 'ADMIN DITSAMAPTA', 'user_password' => Hash::make('123'), 'user_role' => 'ADMIN_SATKER'],
            ['user_id' => 8, 'satker_id' => 8, 'user_name' => 'ADMIN DITPOLAIRUD', 'user_password' => Hash::make('123'), 'user_role' => 'ADMIN_SATKER'],
            ['user_id' => 9, 'satker_id' => 9, 'user_name' => 'ADMIN DITPAMOBVIT', 'user_password' => Hash::make('123'), 'user_role' => 'ADMIN_SATKER'],
            ['user_id' => 10, 'satker_id' => 10, 'user_name' => 'ADMIN DITLANTAS', 'user_password' => Hash::make('123'), 'user_role' => 'ADMIN_SATKER'],
            ['user_id' => 11, 'satker_id' => 11, 'user_name' => 'ADMIN DITBINMAS', 'user_password' => Hash::make('123'), 'user_role' => 'ADMIN_SATKER'],
            ['user_id' => 12, 'satker_id' => 12, 'user_name' => 'ADMIN DITINTELKAM', 'user_password' => Hash::make('123'), 'user_role' => 'ADMIN_SATKER'],
            ['user_id' => 13, 'satker_id' => 13, 'user_name' => 'ADMIN DITRESKRIMUM', 'user_password' => Hash::make('123'), 'user_role' => 'ADMIN_SATKER'],
            ['user_id' => 14, 'satker_id' => 14, 'user_name' => 'ADMIN DITRESKRIMSUS', 'user_password' => Hash::make('123'), 'user_role' => 'ADMIN_SATKER'],
            ['user_id' => 15, 'satker_id' => 15, 'user_name' => 'ADMIN DITRESNARKOBA', 'user_password' => Hash::make('123'), 'user_role' => 'ADMIN_SATKER'],
            ['user_id' => 16, 'satker_id' => 16, 'user_name' => 'ADMIN BIDLABFOR', 'user_password' => Hash::make('123'), 'user_role' => 'ADMIN_SATKER'],
            ['user_id' => 17, 'satker_id' => 17, 'user_name' => 'ADMIN DITTAHTI', 'user_password' => Hash::make('123'), 'user_role' => 'ADMIN_SATKER'],
            ['user_id' => 18, 'satker_id' => 18, 'user_name' => 'ADMIN BIDPROPAM', 'user_password' => Hash::make('123'), 'user_role' => 'ADMIN_SATKER'],
            ['user_id' => 19, 'satker_id' => 19, 'user_name' => 'ADMIN BIDHUMAS', 'user_password' => Hash::make('123'), 'user_role' => 'ADMIN_SATKER'],
            ['user_id' => 20, 'satker_id' => 20, 'user_name' => 'ADMIN BIDKUM', 'user_password' => Hash::make('123'), 'user_role' => 'ADMIN_SATKER'],
            ['user_id' => 21, 'satker_id' => 21, 'user_name' => 'ADMIN BID TIK', 'user_password' => Hash::make('123'), 'user_role' => 'ADMIN_SATKER'],
            ['user_id' => 22, 'satker_id' => 22, 'user_name' => 'ADMIN BIDKEU', 'user_password' => Hash::make('123'), 'user_role' => 'ADMIN_SATKER'],
            ['user_id' => 23, 'satker_id' => 23, 'user_name' => 'ADMIN BIDDOKKES', 'user_password' => Hash::make('123'), 'user_role' => 'ADMIN_SATKER'],
            ['user_id' => 24, 'satker_id' => 24, 'user_name' => 'ADMIN RUMKIT', 'user_password' => Hash::make('123'), 'user_role' => 'ADMIN_SATKER'],
            ['user_id' => 25, 'satker_id' => 25, 'user_name' => 'ADMIN SETUM', 'user_password' => Hash::make('123'), 'user_role' => 'ADMIN_SATKER'],
            ['user_id' => 26, 'satker_id' => 26, 'user_name' => 'ADMIN YANMA', 'user_password' => Hash::make('123'), 'user_role' => 'ADMIN_SATKER'],
            ['user_id' => 27, 'satker_id' => 27, 'user_name' => 'ADMIN SPKT', 'user_password' => Hash::make('123'), 'user_role' => 'ADMIN_SATKER'],
            ['user_id' => 28, 'satker_id' => 1, 'user_name' => 'DANTON ITWASDA', 'user_password' => Hash::make('123'), 'user_role' => 'DANTON'],
            ['user_id' => 29, 'satker_id' => 2, 'user_name' => 'DANTON BIRO OPS', 'user_password' => Hash::make('123'), 'user_role' => 'DANTON'],
            ['user_id' => 30, 'satker_id' => 3, 'user_name' => 'DANTON BIRO RENA', 'user_password' => Hash::make('123'), 'user_role' => 'DANTON'],
            ['user_id' => 31, 'satker_id' => 4, 'user_name' => 'DANTON BIRO SDM', 'user_password' => Hash::make('123'), 'user_role' => 'DANTON'],
            ['user_id' => 32, 'satker_id' => 5, 'user_name' => 'DANTON BIROLOG', 'user_password' => Hash::make('123'), 'user_role' => 'DANTON'],
            ['user_id' => 33, 'satker_id' => 6, 'user_name' => 'DANTON SATBRIMOB', 'user_password' => Hash::make('123'), 'user_role' => 'DANTON'],
            ['user_id' => 34, 'satker_id' => 7, 'user_name' => 'DANTON DITSAMAPTA', 'user_password' => Hash::make('123'), 'user_role' => 'DANTON'],
            ['user_id' => 35, 'satker_id' => 8, 'user_name' => 'DANTON DITPOLAIRUD', 'user_password' => Hash::make('123'), 'user_role' => 'DANTON'],
            ['user_id' => 36, 'satker_id' => 9, 'user_name' => 'DANTON DITPAMOBVIT', 'user_password' => Hash::make('123'), 'user_role' => 'DANTON'],
            ['user_id' => 37, 'satker_id' => 10, 'user_name' => 'DANTON DITLANTAS', 'user_password' => Hash::make('123'), 'user_role' => 'DANTON'],
            ['user_id' => 38, 'satker_id' => 11, 'user_name' => 'DANTON DITBINMAS', 'user_password' => Hash::make('123'), 'user_role' => 'DANTON'],
            ['user_id' => 39, 'satker_id' => 12, 'user_name' => 'DANTON DITINTELKAM', 'user_password' => Hash::make('123'), 'user_role' => 'DANTON'],
            ['user_id' => 40, 'satker_id' => 13, 'user_name' => 'DANTON DITRESKRIMUM', 'user_password' => Hash::make('123'), 'user_role' => 'DANTON'],
            ['user_id' => 41, 'satker_id' => 14, 'user_name' => 'DANTON DITRESKRIMSUS', 'user_password' => Hash::make('123'), 'user_role' => 'DANTON'],
            ['user_id' => 42, 'satker_id' => 15, 'user_name' => 'DANTON DITRESNARKOBA', 'user_password' => Hash::make('123'), 'user_role' => 'DANTON'],
            ['user_id' => 43, 'satker_id' => 16, 'user_name' => 'DANTON BIDLABFOR', 'user_password' => Hash::make('123'), 'user_role' => 'DANTON'],
            ['user_id' => 44, 'satker_id' => 17, 'user_name' => 'DANTON DITTAHTI', 'user_password' => Hash::make('123'), 'user_role' => 'DANTON'],
            ['user_id' => 45, 'satker_id' => 18, 'user_name' => 'DANTON BIDPROPAM', 'user_password' => Hash::make('123'), 'user_role' => 'DANTON'],
            ['user_id' => 46, 'satker_id' => 19, 'user_name' => 'DANTON BIDHUMAS', 'user_password' => Hash::make('123'), 'user_role' => 'DANTON'],
            ['user_id' => 47, 'satker_id' => 20, 'user_name' => 'DANTON BIDKUM', 'user_password' => Hash::make('123'), 'user_role' => 'DANTON'],
            ['user_id' => 48, 'satker_id' => 21, 'user_name' => 'DANTON BID TIK', 'user_password' => Hash::make('123'), 'user_role' => 'DANTON'],
            ['user_id' => 49, 'satker_id' => 22, 'user_name' => 'DANTON BIDKEU', 'user_password' => Hash::make('123'), 'user_role' => 'DANTON'],
            ['user_id' => 50, 'satker_id' => 23, 'user_name' => 'DANTON BIDDOKKES', 'user_password' => Hash::make('123'), 'user_role' => 'DANTON'],
            ['user_id' => 51, 'satker_id' => 24, 'user_name' => 'DANTON RUMKIT', 'user_password' => Hash::make('123'), 'user_role' => 'DANTON'],
            ['user_id' => 52, 'satker_id' => 25, 'user_name' => 'DANTON SETUM', 'user_password' => Hash::make('123'), 'user_role' => 'DANTON'],
            ['user_id' => 53, 'satker_id' => 26, 'user_name' => 'DANTON YANMA', 'user_password' => Hash::make('123'), 'user_role' => 'DANTON'],
            ['user_id' => 54, 'satker_id' => 27, 'user_name' => 'DANTON SPKT', 'user_password' => Hash::make('123'), 'user_role' => 'DANTON'],
            ['user_id' => 55, 'satker_id' => 1, 'user_name' => 'PAMENWAS', 'user_password' => Hash::make('123'), 'user_role' => 'PAMENWAS'],
            ['user_id' => 56, 'satker_id' => 1, 'user_name' => 'SUPER ADMIN', 'user_password' => Hash::make('123'), 'user_role' => 'SUPER_ADMIN'],
        ]);
    }
}
