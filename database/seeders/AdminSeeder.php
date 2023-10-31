<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->first_name = "admin";
        $user->last_name = "admin";
        $user->phone = 23423423423;
        $user->type = 1;
        $user->email = "admin@gmail.com";
        $user->password = Hash::make('admin123');
        $user->save();
    }
}
