<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('shops')->insert([
            array(
                'name' => 'Xe máy Nguyễn Trưởng',
                'email' => 'nguyentruong@gmail.com',
                'phone' => '0928817228',
                'address' => 'Hà Nội',
                'created_at' => now(),
                'updated_at' => now(),
            ),
        ]);

        \DB::table('users')->insert([
            array(
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'shop_id' => 1,
                'user_no' => genderCode('ND', 1),
                'password' => bcrypt('12345678'),
                'phone' => '0928817228',
                'avatar' => '',
                'status' => 1,
                'remember_token' => 'mj3uTuIm9frFWZagAAt27eVc7pXI0b2Yox3UgnSdXJzlHO1iJ6rxhMDaDkBD',
                'created_at' => now(),
                'updated_at' => now(),
            ),
        ]);
    }
}
