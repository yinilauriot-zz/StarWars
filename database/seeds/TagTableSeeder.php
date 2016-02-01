<?php

use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert(
            [
                ['name' => 'Laser'],
                ['name' => 'Casque'],
                ['name' => 'Vaisseau'],
                ['name' => 'Pouvoir'],
                ['name' => 'Chewbacca'],
                ['name' => 'Shubaka'],
                ['name' => 'Tatooine'],
                ['name' => 'Galaxie'],
                ['name' => 'Planète'],
                ['name' => 'Espèce'],
            ]
        );
    }
}
