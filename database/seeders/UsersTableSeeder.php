<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::factory()->count(50)->create();

        $user = User::find(1);
        $user->name = 'test';
        $user->email = '1@qq.com';
        $user->password = bcrypt('1');
        $user->is_admin = true;
        $user->save();
    }
}
