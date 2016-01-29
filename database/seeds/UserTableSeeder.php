<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'name'      => 'yini',
                    'email'     => 'yini@yini.fr',
                    'password'  => Hash::make('yini'),
                    'role'      => 'administrator',
                ],
                [
                    'name'      => 'anna',
                    'email'     => 'anna@anna.fr',
                    'password'  => Hash::make('anna'),
                    'role'      => 'editor',
                ],
                [
                    'name'      => 'tony',
                    'email'     => 'tony@tony.fr',
                    'password'  => Hash::make('tony'),
                    'role'      => 'visitor',
                ],
                [
                    'name'      => 'roman',
                    'email'     => 'roman@roman.fr',
                    'password'  => Hash::make('roman'),
                    'role'      => 'visitor',
                ],
                [
                    'name'      => 'antoine',
                    'email'     => 'antoine@antoine.fr',
                    'password'  => Hash::make('antoine'),
                    'role'      => 'visitor',
                ]
            ]
        );
    }
}
