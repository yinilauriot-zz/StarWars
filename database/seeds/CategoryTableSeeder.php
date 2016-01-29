<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(
            [
                [
                    'title'        => 'Lasers',
                    'description'  => 'Une sorte d\'épée à lame énergétique'
                ],
                [
                    'title'        => 'Casques',
                    'description'  => 'blablabla'
                ]
            ]
        );
    }
}
