<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User ; 

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name"=>"oussama"  , 
            "email"=>"saidi.oussama@gmail.com" , 
            "password"=>"oussama" , 
            "role"=> "admin", 
        ]); 
    }
}
