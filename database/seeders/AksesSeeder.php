<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AksesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $akses = [
            [
                'username' => "admin",
                'role' => "lembaga",
                'pass' => "admin",
                'password'   => bcrypt("admin"),
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],

        ];
        \DB::table('akseslembagas')->insert($akses);
    }
}
