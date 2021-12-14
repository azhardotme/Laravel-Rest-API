<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            ['name' => 'Azhar', 'email' => 'azhar@gmal.com', 'password' => '12345'],
            ['name' => 'Rafi', 'email' => 'rafi@gmal.com', 'password' => '2222'],
            ['name' => 'Sadman', 'email' => 'sadman@gmal.com', 'password' => '12456'],
            ['name' => 'Tonmoy', 'email' => 'tonmoy@gmal.com', 'password' => '13456']
        ];
        User::insert($user);
    }
}
