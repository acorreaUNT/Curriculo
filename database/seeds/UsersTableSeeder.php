<?php

use Illuminate\Database\Seeder;
use App\User;

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
            'name' => 'Administrador',
            'persona' => 'Admin',
            'email' => 'admin@dpa.com',
            'password' => bcrypt('nsyydkhw'),
            'pass' => 'nsyydkhw',
            'rol' => 'admin',
        ]);
        
        User::create([
            'name' => 'Supervisor 1',
            'persona' => 'Supervisor',
            'email' => 'supervisor@dda.com',
            'password' => bcrypt('nsyydkhw'),
            'pass' => 'nsyydkhw',
            'rol' => 'supervisor',
        ]);
    }
}
