<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'avatar'    => 'avatar_admin.png',
            'name'      => 'admin',
            'email'     => 'moriana.mitxel@gmail.com',
            'password'  => bcrypt('Hl4KZC6bQEix7prQck9K'),
            'confirmed' => true,
        ]);

        User::create([
            'avatar'    => 'avatar_anonymous.png',
            'name'      => 'anonymous',
            'email'     => 'moriana.mitxel@gmail.com',
            'password'  => bcrypt('7LxPMSVu93suHQ4s2Ev1'),
            'confirmed' => true,
        ]);
    }
}
