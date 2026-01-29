<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
                DB::table('users')->insert([
            [
                'username' => 'user1@gmail.com',
                'password' => bcrypt('abc123456'),
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'username' => 'teste@gmail.com',
                'password' => bcrypt('12345abcd'),
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
         */
        
        User::factory()->count(100)->create();

    }
}
