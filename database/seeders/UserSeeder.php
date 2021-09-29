<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Admin',
            'phone'=>'017000000',
            'address'=>'Dhaka, Bangladesh',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('12345'),
        ]);
    }
}
