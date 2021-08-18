<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(ProductSeeder::class);              //呼叫執行ProductSeeder
        $this->command->info('產生固定 product 資料');  //執行db:seed給出註解
    }
}
