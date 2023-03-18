<?php

namespace Database\Seeders;

use App\Models\Author;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $images = ["img/authors/person_2.jpg","img/authors/person_3.jpg","img/authors/person_4.jpg","img/authors/person_5.jpg","img/authors/person_6.jpg"];

        foreach (Range(1,30) as $key => $value) {
            $author = new Author();
            $author->name = $faker->firstName();
            $author->surname = $faker->lastName();
            $author->src = $images[rand(0,4)];
            $author->alt = $author->name;
            $author->created_by_user_id = rand(1,30);
            $author->save();
        }
    }
}
