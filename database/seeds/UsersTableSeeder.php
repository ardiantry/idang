<?php

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
        DB::table('users')->insert([
            'name'  		=> 'admin',
            'email'  		=> 'admin@admin.com',
            'username' 		=> 'admin', 
            'status' 		=> 'admin',  
            'password' 	=> bcrypt('admin'),
        ]);
         DB::table('users')->insert([
            'name'  	=> 'anggota',
            'email'  	=> 'anggota@anggota.com',
            'username' 	=> 'anggota', 
            'status' 	=> 'user',  
            'password' 	=> bcrypt('anggota'),
        ]);
    }
}
