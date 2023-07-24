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
            ['identification' => '1234','name' => 'Administrador','password' => bcrypt('admin'),'role' => 'admin', 'created_at' => date("Y-m-d H:i:s")],
            ['identification' => '123','name' => 'Ventas','password' => bcrypt('ventas'),'role' => 'seller', 'created_at' => date("Y-m-d H:i:s")]
        ]);

        DB::table('services')->insert([
            ['name' => 'Hormigó(esistencia 180)','description' => 'Hormigó(esistencia 180)','price' => 6700, 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Hormigó(esistencia 210)','description' => 'Hormigó(esistencia 180)','price' => 6800, 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Hormigó(esistencia 240)','description' => 'Hormigó(esistencia 180)','price' => 7500, 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Hormigó(esistencia 280)','description' => 'Hormigó(esistencia 180)','price' => 8400, 'created_at' => date("Y-m-d H:i:s")],
        ]);

        DB::table('suppliers')->insert([
            ['name' => 'Hormigones Bonao','direction' => 'Bonao','phone' => null, 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Quisquella','direction' => 'Santo Domingo','phone' => null, 'created_at' => date("Y-m-d H:i:s")],
            ['name' => 'Word Concrete','direction' => 'Santo Domingo','phone' => '(809) 527-8516', 'created_at' => date("Y-m-d H:i:s")],
        ]);

    }
}
