<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        // $createdByIDs = [NULL,3,5,7,10,2];

        foreach (Range(1,30) as $key => $value) {
            $user = new User();
            $user->name = $faker->firstName();
            $user->surname = $faker->lastName();
            $user->email = "test".$value."@gmail.com";
            $user->role_id = rand(1,2);
            $user->created_by_user_id = null;
            $user->password = md5("test1234");
            $user->save();
        }
    }
}
