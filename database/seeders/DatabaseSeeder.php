<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            ['identification' => '1234','name' => 'Administrador','password' => bcrypt('admin'),'role' => 'admin'],
            ['identification' => '123','name' => 'Ventas','password' => bcrypt('ventas'),'role' => 'seller']
        ]);

    }
}
