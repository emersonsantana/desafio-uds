<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(ConsumerTableSeeder::class);
        $this->call(OrderTableSeeder::class);
    }
}
